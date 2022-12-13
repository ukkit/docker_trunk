<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJenkins_credentialRequest;
use App\Http\Requests\UpdateJenkins_credentialRequest;
use App\Repositories\Jenkins_credentialRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class Jenkins_credentialController extends AppBaseController
{
    /** @var  Jenkins_credentialRepository */
    private $jenkinsCredentialRepository;

    public function __construct(Jenkins_credentialRepository $jenkinsCredentialRepo)
    {
        $this->jenkinsCredentialRepository = $jenkinsCredentialRepo;
    }

    /**
     * Display a listing of the Jenkins_credential.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $jenkinsCredentials = $this->jenkinsCredentialRepository->all();

        return view('jenkins_credentials.index')
            ->with('jenkinsCredentials', $jenkinsCredentials);
    }

    /**
     * Show the form for creating a new Jenkins_credential.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        return view('jenkins_credentials.create');
    }

    /**
     * Store a newly created Jenkins_credential in storage.
     *
     * @param CreateJenkins_credentialRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateJenkins_credentialRequest $request)
    {
        $input = $request->all();

        $jenkinsCredential = $this->jenkinsCredentialRepository->create($input);

        Flash::success('Jenkins Credential saved successfully.');

        return redirect(route('jenkinsCredentials.index'));
    }

    /**
     * Display the specified Jenkins_credential.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        $jenkinsCredential = $this->jenkinsCredentialRepository->find($id);

        if (empty($jenkinsCredential)) {
            Flash::error('Jenkins Credential not found');

            return redirect(route('jenkinsCredentials.index'));
        }

        return view('jenkins_credentials.show')->with('jenkinsCredential', $jenkinsCredential);
    }

    /**
     * Show the form for editing the specified Jenkins_credential.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        $jenkinsCredential = $this->jenkinsCredentialRepository->find($id);

        if (empty($jenkinsCredential)) {
            Flash::error('Jenkins Credential not found');

            return redirect(route('jenkinsCredentials.index'));
        }

        return view('jenkins_credentials.edit')->with('jenkinsCredential', $jenkinsCredential);
    }

    /**
     * Update the specified Jenkins_credential in storage.
     *
     * @param int $id
     * @param UpdateJenkins_credentialRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateJenkins_credentialRequest $request)
    {
        $jenkinsCredential = $this->jenkinsCredentialRepository->find($id);

        if (empty($jenkinsCredential)) {
            Flash::error('Jenkins Credential not found');

            return redirect(route('jenkinsCredentials.index'));
        }

        $jenkinsCredential = $this->jenkinsCredentialRepository->update($request->all(), $id);

        Flash::success('Jenkins Credential updated successfully.');

        return redirect(route('jenkinsCredentials.index'));
    }

    /**
     * Remove the specified Jenkins_credential from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        $jenkinsCredential = $this->jenkinsCredentialRepository->find($id);

        if (empty($jenkinsCredential)) {
            Flash::error('Jenkins Credential not found');

            return redirect(route('jenkinsCredentials.index'));
        }

        $this->jenkinsCredentialRepository->delete($id);

        Flash::success('Jenkins Credential deleted successfully.');

        return redirect(route('jenkinsCredentials.index'));
    }
}
