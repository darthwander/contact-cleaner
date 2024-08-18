<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mailing;
use App\Models\Company;
use App\Models\MailingsUsageView;

class MailingController extends Controller
{
    public function usage()
    {
        $date = '2024-08-07';
        $uses = MailingsUsageView::selectRaw("TO_CHAR(creation_date, 'DD/MM/YYYY') as creation_date, company_id, company_name, counter, mailings")
            ->whereBetween('creation_date', [$date, $date])
            ->paginate(8);

        return view('mailing.usage', compact('uses'));
    }


    public function unused()
    {
        $date = date('Y-m-d');
        $clients = Company::selectRaw("id,name, (select count(*) from mailings where company_id=clients.id and created_at BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59') as counter")->orderBy('counter', 'asc')->paginate(10);

        return view('mailing.unused', compact('clients'));
    }

    public function processingQueue()
    {
        $date = date('Y-m-d');
        $uses = Mailing::whereBetween('created_at', [$date." 00:00:00", $date." 23:59:59"])->where('status_wipe', '<', 2)->get();

        return view('mailing.queue', compact('uses'));
    }

}
