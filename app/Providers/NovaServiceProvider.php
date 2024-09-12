<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Dashboards\Main;
use App\Nova\Dashboards\ReportDashboard;
use App\Nova\Dashboards\AcDashboard;
use App\Nova\Dashboards\AdminDashboard;
use App\Nova\Dashboards\ArDashboard;
use App\Nova\Dashboards\BillingDashboard;
use App\Nova\Dashboards\BranchDashboard;
use App\Nova\Dashboards\CheckerDashboard;
use App\Nova\Dashboards\FnDashboard;
use App\Nova\Dashboards\LoaderDashboard;
use App\Nova\Dashboards\MkDashboard;
use App\Nova\Dashboards\TruckDashboard;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use App\Nova\User;
use App\Nova\Role;
use App\Nova\Province;
use App\Nova\District;
use App\Nova\SubDistrict;
use App\Nova\Car;
use App\Nova\CompanyProfile;
use App\Nova\Branch;
use App\Nova\Department;
use App\Nova\Position;
use App\Nova\Driving_license_type;
use App\Nova\Employee;
use App\Nova\Cartype;
use App\Nova\Carstyle;
use App\Nova\Car_balance;
use App\Nova\Vendor;
use App\Nova\Businesstype;
use App\Nova\Customer;
use App\Nova\Unit;
use App\Nova\Category;
use App\Nova\Product_style;
use App\Nova\Pricezone;
use App\Nova\Product;
use App\Nova\Productservice_price;
use App\Nova\Service_charge;
use App\Nova\Routeto_branch;
use App\Nova\Branch_route;
use App\Nova\Routeto_branch_cost;
use App\Nova\Charter_route;
use App\Nova\Charter_job;
use App\Nova\Charter_price;
use App\Nova\Quotation;
use App\Nova\Waybill_charter;
use App\Nova\Order_charter;
use App\Nova\Order_checker;
use App\Nova\Order_header;
use App\Nova\Waybill;
use App\Nova\Order_dropship;
use App\Nova\Dropship_tran;
use App\Nova\Order_loader;
use App\Nova\Order_problem;
use App\Nova\Branchrec_waybill;
use App\Nova\Branchrec_order;
use App\Nova\Order_rec;
use App\Nova\Delivery;
use App\Nova\Branch_balance;
use App\Nova\Branch_balance_partner;
use App\Nova\Ar_customer;
use App\Nova\Ar_balance;
use App\Nova\Invoice;
use App\Nova\Receipt_ar;
use App\Nova\Billingnote;
use App\Nova\Bank;
use App\Nova\Bankaccount;
use App\Nova\Order_cash;
use App\Nova\Order_branch;
use App\Nova\Order_banktransfers;
use App\Nova\Receipt_all;
use App\Nova\Carpayment;
use App\Nova\Carreceive;
use App\Nova\Incometype;
use App\Nova\Withholdingtax;
use App\Nova\Company_expense;
use App\Nova\Delivery_costitem;
use App\Nova\PostalCode;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::withBreadcrumbs();
        

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),
                MenuSection::dashboard(TruckDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view truckdashboards');
                            }),
                MenuSection::dashboard(BillingDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view billingdashboards');
                            }),
                MenuSection::dashboard(CheckerDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view checkerdashboards');
                            }),
                MenuSection::dashboard(LoaderDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view loaderdashboards');
                            }),
                MenuSection::dashboard(FnDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view fndashboards');
                            }),   
                MenuSection::dashboard(AcDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view acdashboards');
                            }),                
                MenuSection::dashboard(ReportDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view reportdashboards');
                            }),
                MenuSection::dashboard(MkDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view mkdashboards');
                            }),          
                MenuSection::dashboard(AdminDashboard::class)->icon('document-report')
                            ->canSee(function ($request) {
                                return  $request->user()->hasPermissionTo('view admindashboards');
                            }),      

                MenuSection::make('สำหรับผู้ดูแลระบบ', [
                    MenuItem::resource(CompanyProfile::class),
                    MenuItem::resource(Branch::class),
                    MenuItem::resource(User::class),
                    MenuItem::resource(Role::class),
                    MenuItem::resource(Province::class),
                    MenuItem::resource(District::class),
                    MenuItem::resource(SubDistrict::class),
                    MeNuItem::resource(PostalCode::class),
                ])->icon('office-building')->collapsable(),

                MenuSection::make('ข้อมูลบุคคล', [
                    MenuItem::resource(Department::class),
                    MenuItem::resource(Position::class),
                    MenuItem::resource(Driving_license_type::class),
                    MenuItem::resource(Employee::class),
                ])->icon('users')->collapsable(),

                MenuSection::make('งานรถบรรทุก', [
                    MenuItem::resource(Cartype::class),
                    MenuItem::resource(Carstyle::class),
                    MenuItem::resource(Car::class),
                    MenuItem::resource(Vendor::class),
                    MenuItem::resource(Car_balance::class)
                ])->icon('truck')->collapsable(),


                MenuSection::make('งานการตลาด', [
                    MenuItem::resource(Businesstype::class),
                    MenuItem::resource(Customer::class),
                    MenuItem::resource(Unit::class),
                    MenuItem::resource(Category::class),
                    MenuItem::resource(Product_style::class),
                    MenuItem::resource(Pricezone::class),
                    MenuItem::resource(Product::class),
                    MenuItem::resource(Productservice_price::class),
                    MenuItem::resource(Service_charge::class),
                ])->icon('presentation-chart-bar')->collapsable(),

                MenuSection::make('จัดการข้อมูลขนส่ง', [
                    MenuItem::resource(Routeto_branch::class),
                    MenuItem::resource(Branch_route::class),
                    MenuItem::resource(Routeto_branch_cost::class),
                ])->icon('switch-horizontal')->collapsable(),

                MenuSection::make('งานขนส่งเหมาคัน', [
                    MenuItem::resource(Charter_route::class),
                    MenuItem::resource(Charter_price::class),
                    MenuItem::resource(Quotation::class),
                    MenuItem::resource(Charter_job::class),
                    MenuItem::resource(Waybill_charter::class),
                    MenuItem::resource(Order_charter::class),
                ])->icon('cube-transparent')->collapsable(),

                MenuSection::make('งานขนส่งสินค้าทั่วไป', [
                    MenuItem::resource(Order_checker::class),
                    MenuItem::resource(Order_header::class),
                    MenuItem::resource(Waybill::class),
                    MenuItem::resource(Order_dropship::class),
                    MenuItem::resource(Dropship_tran::class),
                    MenuItem::resource(Order_loader::class),
                    MenuItem::resource(Order_problem::class),
                ])->icon('cube')->collapsable(),

                MenuSection::make('งานขนส่งของสาขา', [
                    MenuItem::resource(Branchrec_waybill::class),
                    MenuItem::resource(Branchrec_order::class),
                    MenuItem::resource(Order_rec::class),
                    MenuItem::resource(Delivery::class),
                    MenuItem::resource(Delivery_costitem::class),
                    MenuItem::resource(Branch_balance::class),
                    MenuItem::resource(Branch_balance_partner::class),
                ])->icon('inbox-in')->collapsable(),

                MenuSection::make('ลูกหนี้การค้า', [
                    MenuItem::resource(Ar_customer::class),
                    MenuItem::resource(Ar_balance::class),
                    MenuItem::resource(Invoice::class),
                    MenuItem::resource(Receipt_ar::class),
                    MenuItem::resource(Billingnote::class),
                ])->icon('credit-card')->collapsable(),

                MenuSection::make('บัญชี-การเงิน', [
                    MenuItem::resource(Bank::class),
                    MenuItem::resource(Bankaccount::class),
                    MenuItem::resource(Company_expense::class),
                    MenuItem::resource(Order_cash::class),
                    MenuItem::resource(Order_branch::class),
                    MenuItem::resource(Order_banktransfers::class),
                    MenuItem::resource(Receipt_all::class),
                    MenuItem::resource(Carpayment::class),
                    MenuItem::resource(Carreceive::class),
                    MenuItem::resource(Incometype::class),
                    MenuItem::resource(Withholdingtax::class),

                ])->icon('cash')->collapsable(),

            ];
        });

        // Nova::footer(function ($request) {
        //     return Blade::render('@env(\'prod\')
        //             This is production!
        //         @endenv
        //     ');
        // });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'wasandev@gmail.com',
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
           
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [

            Main::make(),
            
            ReportDashboard::make()->canSee(function ($request) {
                     return  $request->user()->hasPermissionTo('view reportdashboards');
            }),
            MkDashboard::make()->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view mkdashboards');
            }),

            AdminDashboard::make()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin' || $request->user()->hasPermissionTo('view admindashboards');
                }),
            CheckerDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view checkerdashboards');
                }),
            BillingDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view billingdashboards');
                }),
            LoaderDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view loaderdashboards');
                }),
            ArDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view ardashboards');
                }),
            FnDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view fndashboards');
                }),
            MkDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view mkdashboards');
                }),
            AcDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view acdashboards');
                }),
            TruckDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view truckdashboards');
                }),
            BranchDashboard::make()
                ->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view branchdashboards');
                }),
            
            


        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [

            \Pktharindu\NovaPermissions\NovaPermissions::make()
                ->roleResource(Role::class)
            // new NovaImport,
            // // (new CustomEmailSender())
            // //     ->canSee(function ($request) {
            // //         return $request->user()->role == 'admin';
            // //     }),
            // // new NovaDocumentation,
            // \Mirovit\NovaNotifications\NovaNotifications::make()
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    protected function resources()
    {

        Nova::resourcesIn(app_path('Nova'));
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });
    }

    /**
     * @param  class-string<Lens>  $lens
     * @param  class-string<Resource>  $resource
     */
    private static function resourceLensUrl(string $lens, string $resource): string
    {
        return "/resources/{$resource::uriKey()}/lens/{$lens::make()->uriKey()}";
    }
}
