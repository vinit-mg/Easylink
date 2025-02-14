<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplates;
use App\Http\Requests\StoreEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;

class EmailTemplateController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $this->authorize('adminViewAny', EmailTemplates::class);
       
        $EmailTemplates = (new EmailTemplates)->newQuery();
        
        if (request()->has('search')) {
            $EmailTemplates->where('TemplateName', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $EmailTemplates->orderBy($attribute, $sort_order);
        } else {
            $EmailTemplates->latest();
        }

        $EmailTemplates = $EmailTemplates->paginate(5)->onEachSide(2);
       
        return view('admin.EmailTemplates.index', compact('EmailTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        $this->authorize('adminCreate', EmailTemplates::class);
        return view('admin.EmailTemplates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEmailTemplateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmailTemplateRequest $request){
        $this->authorize('adminCreate', EmailTemplates::class);
        EmailTemplates::create([
            'TemplateName' => $request->TemplateName,
            'EmailSubject' => $request->EmailSubject,
            'EmailFrom' => $request->EmailFrom,
            'EmailTemplate' => $request->EmailTemplate,
        ]);

        return redirect()->route('admin.emailtemplates.index')
                        ->with('message', 'Email template created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\EmailTemplates  $emailtemplate
     * @return \Illuminate\View\View
     */
    public function edit(EmailTemplates $emailtemplate){
        $this->authorize('adminUpdate', EmailTemplates::class);
        return view('admin.EmailTemplates.edit', compact('emailtemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmailTemplateRequest  $request
     * @param  \Models\EmailTemplates  $EmailTemplate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmailTemplateRequest $request, EmailTemplates $emailtemplate){

        $this->authorize('adminUpdate', EmailTemplates::class);

        $emailtemplate->update($request->all());

        return redirect()->route('admin.emailtemplates.index')
                        ->with('message', 'Email template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\EmailTemplates  $EmailTemplate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EmailTemplates $emailtemplate){
        $this->authorize('adminDelete', EmailTemplates::class);

        $emailtemplate->delete();

        return redirect()->route('admin.emailtemplates.index')
                        ->with('message', __('Email template deleted successfully'));
    }
}
