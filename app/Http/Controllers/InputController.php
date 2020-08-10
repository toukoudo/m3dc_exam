<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamLog;

class InputController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            // ファイル名は秒単位なので、同一秒で複数アクセスあると重複するためa
            $requested_timestamp = time();
            $filename_timestamp = date('Y_m_d_H:i:s', $requested_timestamp);
            $content_timestamp = date('Y-m-d h:i:s', $requested_timestamp);
            $f = fopen(storage_path("../logs/{$filename_timestamp}"), 'a');
            // TODO inputの名前も入れる？
            $contents = array(
                        $content_timestamp,
                        $request->input('todohuken'), $request->input('family_name'), $request->input('name'), $request->input('attendees'), 
                        $filename_timestamp, $request->ip(), $request->header('referer'), $request->header('User-Agent'));
            fwrite($f, join(',', $contents));
            fclose($f);

            $exam_log = new ExamLog;
            $exam_log->crnt_date = date('Y-m-d H:i:s', $requested_timestamp);
            $exam_log->todohuken = $request->input('todohuken');
            $exam_log->fname = $request->input('family_name');
            $exam_log->lname = $request->input('name');
            $exam_log->viewcnt = $request->input('attendees');
            $exam_log->ip_addr = $request->ip();
            $exam_log->referer = $request->header('referer');
            $exam_log->user_agent = $request->header('User-Agent');
            $exam_log->save()
            return redirect('/viewpage');
        } elseif ($request->isMethod('get')) {
            $date = config('defaultcfg.defaultcfg.VIEW_INFO_DATE');
            $title = config('defaultcfg.defaultcfg.VIEW_INFO_TITLE');
            $prof  = config('defaultcfg.defaultcfg.VIEW_INFO_PROF');
            return view('viewpages.input', ['date' => $date, 'title' => $title, 'prof' => $prof]);
        }
    }
    
    public function displayview()
    {
        return view('viewpages.viewpage', ['inquiry_url' => config('defaultcfg.defaultcfg.INQUIRY_URL')]);
    }
}
