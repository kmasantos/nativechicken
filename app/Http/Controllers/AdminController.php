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
use App\Models\News;
use App\Models\Report;
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

    public function getFarmSummary(Request $request)
    {
        $farm_id = $request->id;

        $feeding_data = $this->getFeedingPerformanceData($farm_id);

        return response()->json([
            // 'farm_id' => $farm_id,
            // 'animal_type' => $animal_type,
            // 'egg_production' => $egg_production,
            // 'egg_quality' => $egg_quality,
            // 'hatchery_record' => $hatchery_record,
            'feeding_data' => $feeding_data,
        ]);
        
    }

    public function getSales(Request $request)
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
                ->withTrashed()->get()->groupBy('number')
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
                ->withTrashed()->get()->groupBy('number')
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
