<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\FrontendPersonSearchController;
use App\Http\Controllers\frontend\FrontendHomeController;
use App\Http\Controllers\frontend\FrontendNoticeController;
use App\Http\Controllers\frontend\FrontendContactController;
use App\Http\Controllers\frontend\FrontendServiceController;
use App\Http\Controllers\frontend\EServiceController;
use App\Http\Controllers\frontend\FrontendBudgetController;
use App\Http\Controllers\frontend\FrontendActivitiesController;
use App\Http\Controllers\frontend\FrontendLifetimeMemberController;
use App\Http\Controllers\frontend\PdfController;
use App\Http\Controllers\frontend\DonetorController;
use App\Http\Controllers\frontend\FrontendDatabaseController;
use App\Http\Controllers\frontend\SpecificPersonController;

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\AuthenticationController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\FinanceController;
use App\Http\Controllers\backend\MonthlyContributionController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\AccountController;
use App\Http\Controllers\backend\NoticeController;
use App\Http\Controllers\backend\PresidentController;
use App\Http\Controllers\backend\CommitteeActivitieController;
use App\Http\Controllers\backend\CommitteeManageController;
use App\Http\Controllers\backend\CommitteeYearController;
use App\Http\Controllers\backend\CommitteeMemberController;
use App\Http\Controllers\backend\PersonController;
use App\Http\Controllers\backend\DonationController;
use App\Http\Controllers\backend\ExtraController;

// Frontend Routes Start -->
Route::middleware(['viewCount'])->group(function () {
    route::get('/',[FrontendHomeController::class,'home_view'])->name('home');
    route::get('committee-view/{slug}',[FrontendHomeController::class,'comittee_view'])->name('committee');
    route::get('notices',[FrontendNoticeController::class,'notice'])->name('frontend.notice');
    route::get('contact',[FrontendContactController::class,'contact'])->name('contact');
    route::post('message/store',[FrontendContactController::class,'Store'])->name('message.store');
    route::get('about',function (){return view('frontend.pages.about');})->name('about');
    route::get('services-view',[FrontendServiceController::class,'service'])->name('frontend.service');
    route::get('lifetime-member',[EServiceController::class,'lifetime_member_application_view'])->name('lifetime.member');
    route::post('lifetime-member',[EServiceController::class,'lifetime_member_store'])->name('lifetime.member.store');
    route::get('general-member',[EServiceController::class,'general_member_application_view'])->name('general.member');
    route::post('general-member',[EServiceController::class,'general_member_store'])->name('general.member.store');
    route::get('application-success',[EServiceController::class,'application_success_msz'])->name('application.success');
    route::get('techteam', function(){return view('frontend.pages.techteam');})->name('techteam');


    route::get('budgets-view',[FrontendBudgetController::class,'budget'])->name('budget');
    route::get('budget-download/{fileName}',[FrontendBudgetController::class,'budgetDownload'])->name('budget.download');
    route::get('budget-search',[FrontendBudgetController::class,'budgetSearch'])->name('budget.search');


    route::get('donetor-list',[DonetorController::class,'donetorFrontend'])->name('donetor.frontend');
    route::get('top-donetor-list',[DonetorController::class,'topDonetorFrontend'])->name('top.donetor.frontend');


    route::get('committee-activities',[FrontendActivitiesController::class,'committeeActivities'])->name('committee.activities');
    route::get('committee-activities-search',[FrontendActivitiesController::class,'activitieSearch'])->name('committee.activities.search');
    route::get('committee-activities-filter',[FrontendActivitiesController::class,'activitieFilter'])->name('committee.activities.filter');

    route::get('bmjks-database',[FrontendPersonSearchController::class,'bmjksDatabase'])->name('bmjks.database.view');
    route::get('bmjks-database-search',[FrontendPersonSearchController::class,'bmjksDatabaseSearch'])->name('bmjks.database.search');
    route::get('bmjks-database-info',[FrontendDatabaseController::class,'bmjks_database_info'])->name('bmjks.database.info');
    route::get('person-type-data-show/{person}',[FrontendDatabaseController::class,'personTypeDataShow'])->name('personType.data.show');

    route::get('specific-person/{personType}',[SpecificPersonController::class,'specificPerson'])->name('specific.member.view');
    route::get('lifetime-member-view/{personType}',[FrontendLifetimeMemberController::class,'lifetimeMemberView'])->name('lifetime.member.view');
    Route::get('/download-pdf', [PdfController::class, 'download'])->name('download.pdf');
});

// Frontend Routes End <--


// Authentication Route Start -->
Route::get('/Login', [AuthenticationController::class, 'showLoginFrom'])->name('login');
Route::post('/Login', [AuthenticationController::class, 'login'])->name('login.submit');
// Authentication Route End <--

//this is all auth--------------
Route::middleware(['auth'])->group(function () {
    // Dashboard Route Start -->
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Dashboard Route End <--
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout.submit');
    //person route
    Route::resource('person', PersonController::class);
    Route::get('specific-category-person/{personType}', [PersonController::class, 'index'])->name('specific.category.person');
    Route::get('search-person', [PersonController::class, 'personSearch'])->name('person.search');
    Route::any('search-result', [PersonController::class, 'searchResult'])->name('search.result');
    Route::get('person_edit_view/{id}',[ExtraController::class, 'personEditView'])->name('person.edit.view');
    Route::get('/monthly-contribution-view', [MonthlyContributionController::class, 'monthlyContribution'])->name('monthly.contribution.view');
    Route::get('/monthly-contribution-list/{committeeId}', [MonthlyContributionController::class, 'monthlyContributionList'])->name('monthly.contribution.list');
    Route::patch('/monthly-contribution-request/{requestId}', [MonthlyContributionController::class, 'contributionRequest'])->name('contribution.request');


    //this is superadmin route---------------
    Route::middleware('superadmin')->group(function () {
        // Notice Routes Start -->
        Route::resource('notice', NoticeController::class);
        // Notice Routes End <--

        // President Routes Start -->
        Route::get('president', [PresidentController::class,'create_view'])->name('president.create');
        Route::put('president/{id}',[PresidentController::class,'update'])->name('president.update');
        // President Routes End <--


        // Committee Route Start -->
        Route::get('/committee-create', [CommitteeManageController::class, 'committeeCreate'])->name('committee.create');
        Route::post('/committee/year/create', [CommitteeYearController::class, 'committeeYearCreate'])->name('committee.year.create');
        

        //person category route start -->
        Route::get('/tag', [PersonController::class, 'tag'])->name('tag');
        Route::post('/tag', [PersonController::class, 'tagcreate'])->name('tag.create');
        Route::delete('/tag/delete/{id}', [PersonController::class, 'tagdelete'])->name('tag.destroy');
        Route::post('/tag/status/{id}',[PersonController::class, 'tagstatus'])->name('tag.status');
        //person category route end --<

        // Account Routes Start -->
        Route::get('/users/manage', [AccountController::class, 'users'])->name('users.manage');
        Route::post('/users/create', [AccountController::class, 'userStore'])->name('users.store');
        Route::put('/users/password/update/{id}', [AccountController::class, 'passwordUpdate'])->name('password.update');
        Route::delete('/users/delete/{id}', [AccountController::class, 'userDestroy'])->name('account.destroy');
        // Account Routes End <--

        // Services Routes Start
        Route::get('/services', [ServiceController::class, 'services'])->name('services');
        Route::post('/service/store', [ServiceController::class, 'serviceStore'])->name('service.store');
        Route::post('/service/update/{id}', [ServiceController::class, 'serviceUpdate'])->name('service.update');
        Route::delete('/service/destroy/{id}', [ServiceController::class, 'serviceDestroy'])->name('service.destroy');
        // Services Routes End

        // Settings Routes Start
        Route::get('/site/settings', [SettingController::class, 'siteSettings'])->name('site.settings');
        Route::put('/site/settings/branding', [SettingController::class, 'brandingUpdate'])->name('branding.update');
        Route::put('/site/settings/seo', [SettingController::class, 'seoUpdate'])->name('seo.update');
        Route::put('/site/settings/slide-one', [SettingController::class, 'slideOneUpdate'])->name('slide.one.update');
        Route::put('/site/settings/slide-two', [SettingController::class, 'slideTwoUpdate'])->name('slide.two.update');
        Route::put('/site/settings/slide-three', [SettingController::class, 'slideThreeUpdate'])->name('slide.three.update');
        Route::put('/site/settings/slide-four', [SettingController::class, 'slideFourUpdate'])->name('slide.four.update');
        Route::put('/site/settings/slide-five', [SettingController::class, 'slideFiveUpdate'])->name('slide.five.update');
        Route::put('/site/settings/slide-six', [SettingController::class, 'slideSixUpdate'])->name('slide.six.update');
        Route::put('/site/settings/footer-link', [SettingController::class, 'footerLinkUpdate'])->name('footer.link.update');
        Route::put('/site/settings/social', [SettingController::class, 'socialUpdate'])->name('social.update');
        Route::put('/site/settings/contact', [SettingController::class, 'contactInfoUpdate'])->name('contact.update');
        // Settings Routes End

        Route::get('/change/password', [AdminController::class, 'changePassword'])->name('change.password');
    });

    //this is admin route also access superadmin------------------
    Route::middleware('admin')->group(function () {
        Route::get('/active/committee/list', [CommitteeManageController::class, 'committeeActiveListView'])->name('active.committee.list');
        Route::get('/deactive/committee/list', [CommitteeManageController::class, 'committeeDeactiveListView'])->name('deactive.committee.list');
        Route::get('/committee/{id}', [CommitteeYearController::class, 'activeCommittee'])->name('active.committee');
        Route::resource('committeeMember', CommitteeMemberController::class);

        // Person Route Start -->
        
 

        Route::get('general-member-padding-list', [PersonController::class, 'generalMemberPaddingList'])->name('general.member.padding.list');
        Route::post('general-member-approve/{id}', [PersonController::class, 'generalMemberApprove'])->name('general.member.approve');
        
        // Person Route End <--

        // Activities Routes Start -->
        Route::resource('committeeActivities', CommitteeActivitieController::class);
        // Activities Routes End <--

        //Contact Routes Start -->
        Route::middleware('contact')->group(function () {
            Route::get('/contact/unread', [ContactController::class, 'contactUnread'])->name('contact.unread');
            Route::get('/contact/read', [ContactController::class, 'contactRead'])->name('contact.read');
            Route::patch('/contact/read/confirm/{id}', [ContactController::class, 'readConfirm'])->name('contact.read.confirm');
            Route::patch('/contact/unread/confirm/{id}', [ContactController::class, 'unreadConfirm'])->name('contact.unread.confirm');
        });
        //Contact Routes End <--
    });

    //this is cashier route also access superadmin-----------------
    Route::middleware('cashier')->group(function () {
        //donation route Start -->
        Route::get('donation/create', [DonationController::class,'donationCreate'])->name('donation.create');
        Route::post('donation/create', [DonationController::class,'donationStore'])->name('donation.store');
        Route::get('donation/event/list', [DonationController::class,'donationEvent'])->name('donation.event');
        Route::get('donation/event/create', [DonationController::class,'donationEventCreate'])->name('donation.event.create');
        Route::post('donation/event/store', [DonationController::class,'donationEventStore'])->name('donation.event.store');
        Route::post('donation/event/status/{id}', [DonationController::class,'donationEventStatus'])->name('donation.event.status');
        Route::get('donation/event/details/{id}', [DonationController::class,'donationEventDetails'])->name('donation.event.details');
        Route::get('recent/donation/list', [DonationController::class,'recentDonation'])->name('recent.donation');
        Route::get('donator/list', [DonationController::class,'donatorList'])->name('donator.list');
        //donation route end --<

        // Finance Routes Start -->
        Route::get('/finance/sheet', [FinanceController::class, 'finance'])->name('finance.sheet');
        Route::post('/finance/sheet/create', [FinanceController::class, 'sheetCreate'])->name('finance.sheet.create');
        Route::get('/finance/sheet/download/{fileName}', [FinanceController::class, 'sheetDownload'])->name('finance.sheet.download');
        Route::put('/finance/sheet/update/{id}', [FinanceController::class, 'sheetUpdate'])->name('finance.sheet.update');
        Route::delete('/finance/sheet/destroy/{id}', [FinanceController::class, 'sheetDestroy'])->name('finance.sheet.destroy');


        
        Route::patch('/monthly-contribution-approve/{approveId}', [MonthlyContributionController::class, 'contributionApprove'])->name('contribution.approve');
        Route::patch('/monthly-contribution-reject/{rejectId}', [MonthlyContributionController::class, 'contributionReject'])->name('contribution.reject');
        Route::get('/chada-settings-view', [MonthlyContributionController::class, 'chadaSettingsView'])->name('chada.settings.view');
        Route::post('/chada-settings-store', [MonthlyContributionController::class, 'chadaSettingsStore'])->name('chada.settings.store');
        // Finance Routes End <--

        //পারসন রাউট
        Route::post('lifetime-member-approve/{id}', [PersonController::class, 'lifetimeMemberApprove'])->name('lifetime.member.approve');
        Route::get('lifetime-member-padding-list', [PersonController::class, 'lifetimeMemberPaddingList'])->name('lifetime.member.padding.list');
        //পারসন রাউট শেষ    
    });

});



