<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Account;
use App\Models\AccountHistory;
class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountRepository->pushCriteria(new RequestCriteria($request));
        $accounts = $this->accountRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id = null) // to fix the error when it doesn't exist
    {
        if(!isset($id))
        {
            $account = Account::where('user_id',Auth::user()->id)->first();//only get the first one
            
        }else{
            $account = $this->accountRepository->findWithoutFail($id);
        }
        

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }


        $accountHistories = $account->account_histories;
        return view('accounts.show')
        ->with('accountHistories', $accountHistories)
        ->with('account', $account)
        
        ;
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  int              $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }

    //
    public function apply_for_payout(Request $request)
    {
        /*
        *Receive account id
        *Check if logged in user is name as owner of account
        *Update applied for payout filed in accounts table 
        $show success message
        *Apdate account history
        *Redirect and display success message
        */

        

        $account = $this->accountRepository->findWithoutFail($request->input('apply_for_payout'));

        if(empty($account))
        {
            Flash::error('Account not found');

            return redirect(route('accounts.index')); 
        }

        if(Auth::user()->id != $account->user_id)
        {
            Flash::error('You cannot do this its not your account ');

            return redirect()->back();
        }

        Account::where('id',$account->id)->update([
            'applied_for_payout'=>1,
            'paid'=>0,
            'last_date_applied'=>date(),
        ]);


        //we can also send an email first

        AccountHistory::create([
            'user_id'=> Auth::user()->id,
            'account_id'=> $account->id,
            'message'=>'payout request initiated by account owner'
        ]);
        Flash::success('Application submited successfully');
        return redirect()->back();

    }

    public function mark_as_paid(Request $request)
    {

        /*
        *Receive account id
        *Check if logged in user is and admin or moderator
        *Update applied for payout filed in accounts table to 0
        *Update paid filed in accounts table to 1
        *Apdate account history
        $show success message
        *Redirect and display success message
        */

        

        $account = $this->accountRepository->findWithoutFail($request->input('mark_as_paid'));

        if(empty($account))
        {
            Flash::error('Account not found');

            return redirect(route('accounts.index')); 
        }

        if(Auth::user()->role_id > 2)
        {
            Flash::error('You cannot perform this operation u are not admin ');

            return redirect()->back();
        }

        Account::where('id',$account->id)->update([
            'applied_for_payout'=>0,
            'paid'=>1,
            'last_date_paid'=> date(),
        ]);

        AccountHistory::create([
            'user_id'=> $account->user_id,
            'account_id'=> $account->id,
            'message'=>'payment is done by admin : '.Auth::user()->id
        ]);
        //we can also send an email first
        Flash::success('Account marekd as paid ');
        return redirect()->back();
        
    }
}
