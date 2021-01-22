<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
use App\CandidateSkill;
use App\FinalRoundInterviewScheduling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class OfferedRepository
{
    public function getAll()
    {
        $data = InterviewFeedback::orderBy('interview_feedback.created_at', 'DESC')
                ->leftJoin('recruitments','recruitments.id','=','interview_feedback.recruitment_id')
                ->where('interview_feedback.offered','=',1)->get([
                    'interview_feedback.id','interview_feedback.date_of_joining','interview_feedback.recruitment_id','recruitments.name_of_candidate','recruitments.mobile_number','recruitments.email_id',

            ]);
       
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '';
                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }
}