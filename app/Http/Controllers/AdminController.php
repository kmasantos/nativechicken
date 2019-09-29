<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Farm;
use App\Models\Role;
use App\Models\Breed;
use App\Models\Generation;
use App\Models\EggProduction;
use App\Models\EggQuality;
use App\Models\HatcheryRecord;
use App\Models\BreederFeeding;
use App\Models\ReplacementFeeding;
use App\Models\BrooderGrowerFeeding;
use App\Models\MortalitySale;
use App\Models\News;
use App\Models\Line;
use App\Models\Report;
use App\Models\BrooderGrowerGrowth;
use App\Models\ReplacementGrowth;
use Carbon\Carbon;

class AdminController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function userManagementPage()
    {
        return view('admin.user');
    }

    public function newsManagementPage()
    {
        return view('admin.news');
    }

    public function addReportPage()
    {
        return view('admin.add_report');
    }

    public function editReportPage()
    {
        return view('admin.edit_report');
    }

    public function reportsManagementPage()
    {
        return view('admin.reports');
    }

    public function addNewsPage()
    {
        return view('admin.add_news');
    }

    public function editNewsPage()
    {
        return view('admin.edit_news');
    }

    public function farmSummaryPage() 
    {
        return view('admin.farm_summary');
    }
    
    public function createUser(Request $request) 
    {
        try{
            $request->validate([
                'username' => 'required',
                'email' => 'required',
                'farm_code' => 'required',
                'farm_name' => 'required',
                'farm_address' => 'required',
                'breed_selected' => 'required',
            ]);

            if(User::where('email', '=', $request->email)->count() > 0){
                return response()->json(['error'=>'Email already exists']);
            }
            if(Farm::where('code', '=', $request->farm_code)->count() > 0){
                return response()->json(['error'=>'Farm code already exists']);
            }

            try{
                $farm = new Farm;
                $user = new User;
                $farm->name = $request->farm_name;
                $farm->code = $request->farm_code;
                $farm->address = $request->farm_address;
                $farm->breedable_id = $request->breed_selected;
                $farm->save();
                $user->name = $request->username;
                $user->email = $request->email;
                $user->farm_id = $farm->id;
                $role = Role::find(1);
                $user->role_id = $role->id;
                $user->save();
                return response()->json(['success' => $user->name]);
            }catch(Exception $exception) {
                return response()->json(['error'=>'Failed to create user']);
            }
        }catch(Exception $exception){
            return response()->json(['error'=>'Incomplete input']);
        }
    }

    public function blockUnblockUser($user)
    {
        $user = User::find($user);
        $user->blocked = !$user->blocked;
        $user->save();
        return response()->json(['success' => $user->name]);
    }

    public function deleteUser($user)
    {
        $user = User::find($user);
        $name = $user->name;
        $user->delete();
        return response()->json(['success' => $name]);
    }

    public function editUser(Request $request)
    {
        $user = User::find($request->user);
        if(!empty($user)){
            if(!empty($request->username) || !empty($request->email)){
                if(!empty($request->username)){
                    $user->name = $request->username;
                }
                if(!empty($request->email)){
                    $check_email = User::where('email', $request->email)->first();
                    if(empty($check_email)){
                        $user->email = $request->email;    
                    }
                }
                $user->save();
            }
            if(!empty($request->farm_code)){
                $farm = Farm::find($user->farm_id);
                $farm->code = $request->farm_code;
                $farm->save();
            }
            return response()->json(['success' => "Successfully edited ".$user->name]);
        }
        return response()->json(['error' => "Failed to edit ".$user->name]);
    }

    // News

    public function addNews(Request $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->save();

       return response()->json([
            'news' => $news
        ]);
    }

    public function editNews(Request $request)
    {
        $news = News::find($request->id);
        if ($news) {
            $news->title = $request->title;
            $news->content = $request->content;
            $news->updated_at = now();
            $news->save();
            return response()->json([
                'news' => $news
            ]);
        }

        else return response()->json([
            'error' => 'News Not Found'
        ], 404);
    }


    public function publishNews($news_id)
    {
        $news = News::find($news_id);
        $news->published_at = now();
        $news->save();

        return response()->json([
            'news' => $news
        ]);
    }

    public function archiveNews($news_id)
    {
        $news = News::find($news_id);
        $news->archived_at = now();
        $news->save();

        return response()->json([
            'news' => $news
        ]);
    }

    public function getNews($news_id)
    {
        $news = News::find($news_id);
        return response()->json([
            'news' => $news
        ]);
    }

    // reports

    public function addReport(Request $request)
    {
        $report = new Report;
        $report->title = $request->title;
        $report->content = $request->content;
        $report->year = $request->year;
        $report->save();

       return response()->json([
            'report' => $report
        ]);
    }

    public function editReport(Request $request)
    {
        $report = Report::find($request->id);
        if ($report) {
            $report->title = $request->title;
            $report->content = $request->content;
            $report->year = $request->year;
            $report->updated_at = now();
            $report->save();
            return response()->json([
                'reports' => $report
            ]);
        }

        else return response()->json([
            'error' => 'Report Not Found'
        ], 404);
    }


    public function publishReport($report_id)
    {
        $report = Report::find($report_id);
        $report->published_at = now();
        $report->save();

        return response()->json([
            'report' => $report
        ]);
    }

    public function archiveReport($report_id)
    {
        $report = Report::find($report_id);
        $report->archived_at = now();
        $report->save();

        return response()->json([
            'report' => $report
        ]);
    }

    public function getReport($report_id)
    {
        $report = Report::find($report_id);
        return response()->json([
            'report' => $report
        ]);
    }

    // Farm Status

    // Family

    public function getFamSales(Request $request)
    {   

        $gen_id = $request->id;
        $farm_id = Generation::where('id', $gen_id)->first()->farm_id;
        $lines = Line::where('generation_id', $gen_id)->with('families')->get();
        
        $breeder_data = MortalitySale::join('breeder_inventories', 'breeder_inventories.id', 'mortality_sales.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('generations.id', $gen_id)
                ->whereIn('mortality_sales.type', ["breeder", "egg"])
                ->where('mortality_sales.category', "sold")
                ->select('mortality_sales.*', 'lines.number as line_number', 'families.number as family_number')
                ->withTrashed()
                ->get()
                ->groupBy('line_number')
                ->map(function ($line) { return $this->computeSales($line->groupBy('family_number')); });

        $replacement_data = MortalitySale::join('replacement_inventories', 'replacement_inventories.id', 'mortality_sales.replacement_inventory_id')
                ->join('replacements', 'replacements.id', 'replacement_inventories.replacement_id')
                ->join('families', 'families.id', 'replacements.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('generations.id', $gen_id)
                ->where('mortality_sales.type', "replacement")
                ->where('mortality_sales.category', "sold")
                ->select('mortality_sales.*', 'lines.number as line_number', 'families.number as family_number')
                ->withTrashed()
                ->get()
                ->groupBy('line_number')
                ->map(function ($line) { return $this->computeSales($line->groupBy('family_number')); });

        $brooder_data = MortalitySale::join('brooder_grower_inventories', 'brooder_grower_inventories.id', 'mortality_sales.brooder_inventory_id')
                ->join('brooder_growers', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
                ->join('families', 'families.id', 'brooder_growers.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('generations.id', $gen_id)
                ->where('mortality_sales.type', "brooder")
                ->where('mortality_sales.category', "sold")
                ->select('mortality_sales.*', 'lines.number as line_number', 'families.number as family_number')
                ->withTrashed()
                ->get()
                ->groupBy('line_number')
                ->map(function ($line) { return $this->computeSales($line->groupBy('family_number')); });

        return response()->json([
            'breeder_data' => $breeder_data,
            'replacement_data' => $replacement_data,
            'brooder_data' => $brooder_data,
            'lines' => $lines,
        ]);
    }

    public function getFamHatcherydata(Request $request)
    {   

        $gen_id = $request->id;
        $farm_id = Generation::where('id', $gen_id)->first()->farm_id;
        $lines = Line::where('generation_id', $gen_id)->with('families')->get();

        $hatchery_data = HatcheryRecord::join('breeder_inventories', 'breeder_inventories.id', 'hatchery_records.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id',$farm_id)
                ->where('generations.id', $gen_id)
                ->select('hatchery_records.*', 'lines.number as line_number', 'families.number as family_number')
                ->withTrashed()
                ->get()
                ->groupBy('line_number')
                ->map(function ($line) {
                    return $line
                        ->groupBy('family_number')
                        ->map(function ($fam) {
                            return $fam->reduce(function ($acc, $item) {
                                $acc['eggs_set'] += $item['number_eggs_set'];
                                $acc['eggs_fertile'] += $item['number_fertile'];
                                $acc['eggs_hatched'] += $item['number_hatched'];
                                
                                if ($acc['eggs_set'] != 0) {
                                    $acc['fertility'] = number_format(($acc['eggs_fertile'] / $acc['eggs_set']) * 100, 2, '.', "");
                                    $acc['hatchability'] = number_format(($acc['eggs_hatched'] / $acc['eggs_set']) * 100, 2, '.', "");
                                }

                                return $acc;
                            }, [
                                'eggs_set' => null,
                                'eggs_fertile' => null,
                                'eggs_hatched' => null,
                                'fertility' => null,
                                'hatchability' => null,
                            ]);
                        });
                });
            
        return response()->json([
            'hatchery_data' => $hatchery_data,
            'lines' => $lines,
        ]);
    }

    public function getFamEggProdData(Request $request)
    {
        $gen_id = $request->id;
        $farm_id = Generation::where('id', $gen_id)->first()->farm_id;
        $lines = Line::where('generation_id', $gen_id)->with('families')->get();

        $egg_production = EggProduction::join('breeder_inventories', 'breeder_inventories.id', 'egg_productions.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('generations.id', $gen_id)
                ->select('egg_productions.*', 'lines.number as line_number', 'families.number as family_number')
                ->withTrashed()
                ->get()
                ->groupBy('line_number')
                ->map(function ($line) {
                    return $line
                        ->groupBy('family_number')
                        ->map(function ($fam) {
                            return $fam->reduce(function ($acc, $item) {

                                $acc['total_broken'] += $item['total_broken'];
                                $acc['total_rejects'] += $item['total_rejects'];
                                $acc['total_intact'] += $item['total_eggs_intact'];
                                $acc['total_weight'] += $item['total_egg_weight'];

                                if($item['female_inventory']) {
                                    $acc['inventory'] += $item['female_inventory'];
                                    $acc['compute'] += $acc['total_intact'] + $acc['total_broken'] + $acc['total_rejects'];
                                }

                                return $acc;
                            }, [
                                'total_broken' => null,
                                'total_rejects' => null,
                                'total_intact' => null,
                                'total_weight' => null,
                                'inventory' => null,
                                'compute' => null,
                            ]);
                        });
                });

        return response()->json([
            'egg_production' => $egg_production,
            'lines' => $lines
        ]);
    }

    // Generation
    public function getGrowthRecords(Request $request)
    {
        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();

        $brooder_data = BrooderGrowerGrowth::join('brooder_grower_inventories', 'brooder_grower_inventories.id', 'brooder_grower_growths.broodergrower_inventory_id')
                ->join('brooder_growers', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
                ->join('families', 'families.id', 'brooder_growers.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('brooder_grower_growths.*', 'generations.number')
                ->withTrashed()
                ->get();
        $grower_data = ReplacementGrowth::join('replacement_inventories', 'replacement_inventories.id', 'replacement_growths.replacement_inventory_id')
                ->join('replacements', 'replacements.id', 'replacement_inventories.replacement_id')
                ->join('families', 'families.id', 'replacements.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('replacement_growths.*', 'generations.number')
                ->withTrashed()->get();
    
        $joined = $this->computeGrowth($brooder_data->concat($grower_data));

        return response()->json([
            'growth_records' => $joined,
            'farm_generations' => $farm_generations,
        ]);
    }

    public function getEggProductionData(Request $request)
    {
        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();

        $egg_production = EggProduction::join('breeder_inventories', 'breeder_inventories.id', 'egg_productions.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('egg_productions.*', 'generations.number')
                ->withTrashed()
                ->get()
                ->groupBy('number')
                ->map(function ($gen) {
                    return $gen->reduce(function ($acc, $item) {

                        $acc['total_broken'] += $item['total_broken'];
                        $acc['total_rejects'] += $item['total_rejects'];
                        $acc['total_intact'] += $item['total_eggs_intact'];
                        $acc['total_weight'] += $item['total_egg_weight'];

                        if($item['female_inventory']) {
                            $acc['inventory'] += $item['female_inventory'];
                            $acc['compute'] += $acc['total_intact'] + $acc['total_broken'] + $acc['total_rejects'];
                        }

                        return $acc;
                    }, [
                        'total_broken' => null,
                        'total_rejects' => null,
                        'total_intact' => null,
                        'total_weight' => null,
                        'inventory' => null,
                        'compute' => null,
                    ]);
                });

        return response()->json([
            'egg_production' => $egg_production,
            'farm_generations' => $farm_generations,
        ]);
    }

    public function getMortality(Request $request)
    {
        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();

        $breeder_data = $this->computeMortality(MortalitySale::join('breeder_inventories', 'breeder_inventories.id', 'mortality_sales.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->whereIn('mortality_sales.type', ["breeder", "egg"])
                ->where('mortality_sales.category',"died")
                ->select('mortality_sales.*', 'generations.number')
                ->withTrashed()
                ->get());

        $replacement_data = $this->computeMortality(MortalitySale::join('replacement_inventories', 'replacement_inventories.id', 'mortality_sales.replacement_inventory_id')
                ->join('replacements', 'replacements.id', 'replacement_inventories.replacement_id')
                ->join('families', 'families.id', 'replacements.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('mortality_sales.type', "replacement")
                ->where('mortality_sales.category',"died")
                ->select('mortality_sales.*', 'generations.number')
                ->withTrashed()
                ->get());

        $brooder_data = $this->computeMortality(MortalitySale::join('brooder_grower_inventories', 'brooder_grower_inventories.id', 'mortality_sales.brooder_inventory_id')
                ->join('brooder_growers', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
                ->join('families', 'families.id', 'brooder_growers.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('mortality_sales.type', "brooder")
                ->where('mortality_sales.category',"died")
                ->select('mortality_sales.*', 'generations.number')
                ->withTrashed()
                ->get());


        return response()->json([
            'farm_generations' => $farm_generations,
            'brooder_data' => $brooder_data,
            'breeder_data' => $breeder_data,
            'replacement_data' => $replacement_data,
        ]);
    }

    public function getSales(Request $request)
    {  

        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();
        
        $replacement_data = $this->computeSales(MortalitySale::join('replacement_inventories', 'replacement_inventories.id', 'mortality_sales.replacement_inventory_id')
                ->join('replacements', 'replacements.id', 'replacement_inventories.replacement_id')
                ->join('families', 'families.id', 'replacements.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('mortality_sales.type', "replacement")
                ->where('mortality_sales.category', "sold")
                ->select('mortality_sales.*', 'generations.number')
                ->withTrashed()->get()->groupBy('number'));

        $breeder_data = $this->computeSales(MortalitySale::join('breeder_inventories', 'breeder_inventories.id', 'mortality_sales.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->whereIn('mortality_sales.type', ["breeder", "egg"])
                ->where('mortality_sales.category', "sold")
                ->select('mortality_sales.*', 'generations.number')
                ->withTrashed()->get()->groupBy('number'));
        
        $brooder_data = $this->computeSales(MortalitySale::join('brooder_grower_inventories', 'brooder_grower_inventories.id', 'mortality_sales.brooder_inventory_id')
                ->join('brooder_growers', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
                ->join('families', 'families.id', 'brooder_growers.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->where('mortality_sales.type', "brooder")
                ->where('mortality_sales.category', "sold")
                ->select('mortality_sales.*', 'generations.number')
                ->withTrashed()->get()->groupBy('number'));

        return response()->json([
            'replacement_data' => $replacement_data,
            'breeder_data' => $breeder_data,
            'brooder_data' => $brooder_data,
            'farm_generations' => $farm_generations,
        ]);
    }

    public function getEggQualityData(Request $request)
    {   

        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();

        $egg_quality = EggQuality::join('breeder_inventories', 'breeder_inventories.id', 'egg_qualities.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('egg_qualities.*', 'generations.number')
                ->withTrashed()
                ->get()
                ->groupBy('number')
                ->map(function ($gen) {
                    $data = $gen
                        ->groupBy('egg_quality_at')
                        ->map(function ($array) {
                            if ($array) {
                                return $array->reduce(function ($acc, $item) use($array) {
                                    $count =  $array->count();

                                    $acc['weight_sum'] += $item->weight;
                                    $weight_mean = $acc['weight_sum'] / $count;
                                    $acc['weight_variance'] += pow($item->weight - $weight_mean, 2);
                                    $acc['weight'] = [ 'mean' => $weight_mean, 'std' => (float) sqrt($acc['weight_variance'] / $count) ];

                                    $acc['length_sum'] += $item->length;
                                    $length_mean = $acc['length_sum'] / $count;
                                    $acc['length_variance'] += pow($item->length - $length_mean, 2);
                                    $acc['length'] = [ 'mean' => $length_mean, 'std' => (float) sqrt($acc['length_variance'] / $count) ];

                                    $acc['width_sum'] += $item->width;
                                    $width_mean = $acc['width_sum'] / $count;
                                    $acc['width_variance'] += pow($item->width - $width_mean, 2);
                                    $acc['width'] = [ 'mean' => $width_mean, 'std' => (float) sqrt($acc['width_variance'] / $count) ];
                                
                                    if (($item->thickness_top && $item->thickness_top > 0) 
                                        && ($item->thickness_mid && $item->thickness_mid > 0)
                                        && ($item->thickness_bot && $item->thickness_bot > 0)) {
                                        $shell_thickness = ($item->thickness_top + $item->thickness_mid + $item->thickness_bot) / 3;
                                        $acc['shell_thickness_sum'] += $shell_thickness;
                                        $shell_thickness_mean = $acc['shell_thickness_sum'] / $count;
                                        $acc['shell_thickness_variance'] += pow($shell_thickness - $shell_thickness_mean, 2);
                                        $acc['shell_thickness'] = [ 'mean' => $shell_thickness_mean, 'std' => (float) sqrt($acc['shell_thickness_variance'] / $count) ];
                                    }

                                    if ($item->shell_weight && $item->shell_weight > 0) {
                                        $acc['shell_weight_sum'] += $item->shell_weight;
                                        $shell_weight_mean = $acc['shell_weight_sum'] / $count;
                                        $acc['shell_weight_variance'] += pow($item->shell_weight - $shell_weight_mean, 2);
                                        $acc['shell_weight'] = [ 'mean' => $shell_weight_mean, 'std' => (float) sqrt($acc['shell_weight_variance'] / $count) ];
                                    }

                                    if ($item->yolk_weight && $item->yolk_weight > 0) {
                                        $acc['yolk_weight_sum'] += $item->yolk_weight;
                                        $yolk_weight_mean = $acc['yolk_weight_sum'] / $count;
                                        $acc['yolk_weight_variance'] += pow($item->yolk_weight - $yolk_weight_mean, 2);
                                        $acc['yolk_weight'] = [ 'mean' => $yolk_weight_mean, 'std' => (float) sqrt($acc['yolk_weight_variance'] / $count) ];
                                    }

                                    if ($item->albumen_height && $item->albumen_height > 0) {
                                        $acc['albumen_height_sum'] += $item->albumen_height;
                                        $albumen_height_mean = $acc['albumen_height_sum'] / $count;
                                        $acc['albumen_height_variance'] += pow($item->albumen_height - $albumen_height_mean, 2);
                                        $acc['albumen_height'] = [ 'mean' => $albumen_height_mean, 'std' => (float) sqrt($acc['albumen_height_variance'] / $count) ];
                                    }

                                    if ($item->albumen_weight && $item->albumen_weight > 0) {
                                        $acc['albumen_weight_sum'] += $item->albumen_weight;
                                        $albumen_weight_mean = $acc['albumen_weight_sum'] / $count;
                                        $acc['albumen_weight_variance'] += pow($item->albumen_weight - $albumen_weight_mean, 2);
                                        $acc['albumen_weight'] = [ 'mean' => $albumen_weight_mean, 'std' => (float) sqrt($acc['albumen_weight_variance'] / $count) ];
                                    }

                                    
                                    return $acc;
                                }, [
                                    'weight' => null,
                                    'weight_sum' => 0,
                                    'weight_variance' => 0,
                                    'length' => null,
                                    'length_sum' => 0,
                                    'length_variance' => 0,
                                    'width' => null,
                                    'width_sum' => 0,
                                    'width_variance' => 0,
                                    'shell_thickness' => null,
                                    'shell_thickness_sum' => 0,
                                    'shell_thickness_variance' => 0,
                                    'shell_weight' => null,
                                    'shell_weight_sum' => 0,
                                    'shell_weight_variance' => 0,
                                    'yolk_weight' => null,
                                    'yolk_weight_sum' => 0,
                                    'yolk_weight_variance' => 0,
                                    'albumen_height' => null,
                                    'albumen_height_sum' => 0,
                                    'albumen_height_variance' => 0,
                                    'albumen_weight' => null,
                                    'albumen_weight_sum' => 0,
                                    'albumen_weight_variance' => 0,
                                    'shape' => $array->mode('shape')[0],
                                    'color' => $array->mode('color')[0],
                                ]);
                            }

                            return [];
                        });
                    return $data;
                });

            
        return response()->json([
            'egg_quality' => $egg_quality,
            'farm_generations' => $farm_generations,
        ]);
    }

    public function getHatcherydata(Request $request)
    {   

        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();

        $hatchery_data = HatcheryRecord::join('breeder_inventories', 'breeder_inventories.id', 'hatchery_records.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('hatchery_records.*', 'generations.number')
                ->withTrashed()
                ->get()
                ->groupBy('number')
                ->map(function ($gen) {
                    return $gen->reduce(function ($acc, $item) {

                        $acc['eggs_set'] += $item['number_eggs_set'];
                        $acc['eggs_fertile'] += $item['number_fertile'];
                        $acc['eggs_hatched'] += $item['number_hatched'];
                        
                        if ($acc['eggs_set'] != 0) {
                            $acc['fertility'] = number_format(($acc['eggs_fertile'] / $acc['eggs_set']) * 100, 2, '.', "");
                            $acc['hatchability'] = number_format(($acc['eggs_hatched'] / $acc['eggs_set']) * 100, 2, '.', "");
                        }

                        return $acc;
                    }, [
                        'eggs_set' => null,
                        'eggs_fertile' => null,
                        'eggs_hatched' => null,
                        'fertility' => null,
                        'hatchability' => null,
                    ]);
                });
            
        return response()->json([
            'hatchery_data' => $hatchery_data,
            'farm_generations' => $farm_generations,
        ]);
    }

    public function getFeedingPerformanceData(Request $request)
    {   
        $farm_id = $request->id;
        $farm_generations = Generation::where('farm_id', $farm_id)->get();

        $breeder_feeding = $this->computeFeedingPerformance(BreederFeeding::join('breeder_inventories', 'breeder_inventories.id', 'breeder_feedings.breeder_inventory_id')
                ->join('breeders', 'breeders.id', 'breeder_inventories.breeder_id')
                ->join('families', 'families.id', 'breeders.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('breeder_feedings.*', 'generations.number')
                ->withTrashed()->get());

        $replacement_feeding = $this->computeFeedingPerformance(ReplacementFeeding::join('replacement_inventories', 'replacement_inventories.id', 'replacement_feedings.replacement_inventory_id')
                ->join('replacements', 'replacements.id', 'replacement_inventories.replacement_id')
                ->join('families', 'families.id', 'replacements.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('replacement_feedings.*', 'generations.number')
                ->withTrashed()->get());

        $brooder_feeding = $this->computeFeedingPerformance(BrooderGrowerFeeding::join('brooder_grower_inventories', 'brooder_grower_inventories.id', 'brooder_grower_feedings.broodergrower_inventory_id')
                ->join('brooder_growers', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
                ->join('families', 'families.id', 'brooder_growers.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->where('generations.farm_id', $farm_id)
                ->select('brooder_grower_feedings.*', 'generations.number')
                ->withTrashed()->get());

        return response()->json([
            'farm_generations' => $farm_generations,
            'breeder_feeding' => $breeder_feeding,
            'replacement_feeding' => $replacement_feeding,
            'brooder_feeding' => $brooder_feeding,
        ]);
    }

    /**
     ** Helper Functions
    **/
    public function computeGrowth($data)
    {
        return $data
            ->groupBy('number')
            ->map(function ($gen) {
                return $gen
                    ->groupBy('collection_day')
                    ->map(function ($day) {
                        return $day->reduce(function ($acc, $item) use ($day) {
                            
                            $count = $day->count();

                            $acc['male_sum'] += $item->male_weight;
                            $male_mean = $acc['male_sum'] / $count;
                            $acc['male_variance'] += pow($item->male_weight - $male_mean, 2);
                            $acc['male_mean'] = $male_mean;
                            $acc['male_sd'] = (float) sqrt($acc['male_variance'] / $count);
                            
                            $acc['female_sum'] += $item->female_weight;
                            $female_mean = $acc['female_sum'] / $count;
                            $acc['female_variance'] += pow($item->female_weight - $female_mean, 2);
                            $acc['female_mean'] = $female_mean;
                            $acc['female_sd'] = (float) sqrt($acc['female_variance'] / $count);

                            $acc['total_sum'] += $item->total_weight;
                            $total_mean = $acc['total_sum'] / $count;
                            $acc['total_variance'] += pow($item->total_weight - $total_mean, 2);
                            $acc['total_mean'] = $total_mean;
                            $acc['total_sd'] = (float) sqrt($acc['total_variance'] / $count);

                            return $acc;
                        }, [
                            'total_mean' => null,
                            'total_sd' => null,
                            'total_sum' => 0,
                            'total_variance' => 0,
                            'female_mean' => null,
                            'female_sd' => null,
                            'female_sum' => 0,
                            'female_variance' => 0,
                            'male_mean' => null,
                            'male_sd' => null,
                            'male_sum' => 0,
                            'male_variance' => 0,
                        ]);
                    });
            });
    }
    public function computeMortality($data)
    {
        return $data
            ->groupBy('number')
            ->map(function ($gen) {
                return $gen
                    ->groupBy('reason')
                    ->map(function ($reason) {
                        return $reason->reduce(function ($acc, $item) {

                            $acc['male'] += $item['male'];
                            $acc['female'] += $item['female'];

                            return $acc;
                        }, [
                            'male' => 0,
                            'female' => 0
                        ]);
                    });
            });
    }

    public function computeSales($data)
    {
        return $data
            ->map(function ($sales) {
                return $sales->reduce(function ($acc, $item) use ($sales) {

                    $count = $sales->count();

                    $acc['male'] += $item['male'];
                    $acc['female'] += $item['female'];
                    $acc['total'] += $item['total'];
                    
                    $acc['price_sum'] += $item->price;
                    $price_mean = $acc['price_sum'] / $count;
                    $acc['price_variance'] += pow($item->price - $price_mean, 2);
                    $acc['price_mean'] = $price_mean;
                    $acc['price_sd'] = (float) sqrt($acc['price_variance'] / $count);

                    return $acc;
                }, [
                    'price_mean' => null,
                    'price_sd' => null,
                    'price_sum' => 0,
                    'price_variance' => 0,
                    'total' => null,
                    'female' => null,
                    'male' => null,
                ]);
            });
    }

    public function computeFeedingPerformance($data)
    {
        return $data->groupBy('number')
            ->map(function ($gen) {
                return $gen->reduce(function ($acc, $item) {

                    $acc['total_fed'] += $item['amount_offered'];
                    $acc['total_refused'] += $item['amount_refused'];
                    $acc['total_consumption'] = $acc['total_fed'] - $acc['total_refused'];

                    return $acc;
                }, [
                    'total_fed' => null,
                    'total_refused' => null,
                    'total_consumption' => null,
                ]);
            });
    }

    public function getGenerations(Request $request)
    {
        $farm_id = $request->id;
        $generations = Generation::where('farm_id', $farm_id)
            ->orderBy('numerical_generation', 'desc')->get();

        return response()->json([
            'generations' => $generations,
        ]);
    }

    public function getNewsList(Request $request)
    {
        $news = News::paginate(10);
        return $news;
    }

    public function getReportsList(Request $request)
    {
        $reports = Report::paginate(10);
        return $reports;
    }

    public function getUserList ()
    {
        $users = User::join('farms', 'users.farm_id', 'farms.id')
            ->join('roles', 'users.role_id', 'roles.id')
            ->where('users.id', '!=', Auth::user()->id)
            ->select('users.*', 'farms.*', 'roles.*', 'users.id as user_id', 'farms.id as farm_id', 'roles.id as role_id', 
            'users.name as user_name', 'farms.name as farm_name')
            ->paginate(10);
        return $users;
    }

    public function getBreedList () 
    {
        $breeds = Breed::all();
        return $breeds;
    }
    
}
