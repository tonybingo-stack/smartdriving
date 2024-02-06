<?php

namespace App\Http\Controllers\Admin;
use App\Models\TrackDay;
use Illuminate\Http\Request;

class TrackDayController extends TemplateController
{
    public function __construct(TrackDay $trackDay)
    {
        parent::__construct($trackDay, 'Admin/TrackDay/IndexTrackDays', 'description');
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), $this->validationRules());

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $createdTrackDays = [];


        $datesDecoded = json_decode($request->track_dates, true);
        $dates = $this->extractDates($datesDecoded);
        foreach ($dates as $date) {
            $trackDayData = $request->except('dates', 'cars');
            $trackDayData['date'] = $date; 

            $trackDay = TrackDay::create($trackDayData);

            if ($request->has('cars')) {
                $cars = json_decode($request->cars, true);
                $carIds = $this->extractCarIds($cars);
                $trackDay->cars()->sync($carIds);
            }

            $createdTrackDays[] = $trackDay;
        }
    
        return response()->json(['data' => $createdTrackDays], 201);
    }

    public function update(Request $request, $id)
    {
        $trackDay = TrackDay::findOrFail($id);


        // $validator = Validator::make($request->all(), $this->validationRules());

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $trackDay->update($request->all());

        if ($request->has('cars')) {
            $cars = json_decode($request->cars, true);
            $carIds = $this->extractCarIds($cars);
            $trackDay->cars()->sync($carIds);
        }

    
        return response()->json(['data' => $trackDay]);
    }

    private function extractCarIds($carsPayload)
    {
        return collect($carsPayload)
            ->pluck('id')
            ->filter() 
            ->all();
    }

    private function extractDates($datesPayload)
    {
        return collect($datesPayload)
            ->pluck('date')
            ->filter() 
            ->all();
    }
}
