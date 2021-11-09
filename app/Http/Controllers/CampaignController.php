<?php

namespace App\Http\Controllers;

use App\Mail\MarketingMail;
use App\Models\Campaign;
use App\Models\CustomerGroup;
use App\Models\Template;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CampaignController extends Controller
{

    /**
     * @var string[]
     */
    private $rules = [
        'name' => 'required|string',
        'date' => 'required|date',
        'hour' => 'required|between:0,24',
        'minute' => 'required|between:0,60',
        'template_id' => 'required|exists:templates,id',
        'customer_group_id' => 'required|exists:customer_groups,id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('campaigns/index', [
            'campaigns' => Campaign::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('campaigns/create', [
            'templates' => Template::all(),
            'customerGroups' => CustomerGroup::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);

        $validated['sent'] = $request->has('sent');

        $validated['send_at'] = Carbon::createFromFormat('Y-m-d H:i:s',
            $request->date . ' ' . $validated['hour'] . ':' . $validated['minute'] . ':00');

        $campaign = Campaign::create($validated);

        return redirect()->route('campaigns.index')->with('success', 'Campaign stored')->with(['campaign' => $campaign]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $dt = Carbon::create($campaign->send_at);
        $date = $dt->format('Y-m-d');
        $hour = $dt->hour;
        $minute = $dt->minute;
        return response()->view('campaigns/create', [
            'campaignDate' => $date,
            'campaignHour' => $hour,
            'campaignMinute' => $minute,
            'campaign' => $campaign,
            'templates' => Template::all(),
            'customerGroups' => CustomerGroup::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate($this->rules);

        $validated['sent'] = $request->has('sent');

        $validated['send_at'] = Carbon::createFromFormat('Y-m-d H:i:s',
            $request->date . ' ' . $validated['hour'] . ':' . $validated['minute'] . ':00');

        $campaign->update($validated);

        return redirect()->route('campaigns.index')->with('success', 'Campaign updated')->with(['campaign' => $campaign]);
    }

    /**
     * @param Request $request
     * @param Campaign $campaign
     */
    public function mail(Request $request, Campaign $campaign, MailService $mailService)
    {
        $mailService->mailCampaign($campaign);

        return redirect()->route('campaigns.index')->with('success', 'Campaign emailed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')->with('success', 'Campaign deleted');
    }
}
