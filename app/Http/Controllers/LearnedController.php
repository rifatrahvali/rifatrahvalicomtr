<?php

namespace App\Http\Controllers;

use App\Models\LearnedExperience;
use App\Models\LearnedEducation;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearnedController extends Controller
{
    // İş deneyimlerinden kazanımların listesi
    public function experiencesIndex()
    {
        $experiences = Auth::user()->experiences()->with('learnedExperiences')->get();
        return view('learned.experiences.index', compact('experiences'));
        // Türkçe yorum: Kullanıcının iş deneyimlerinden elde ettiği kazanımlar listelenir.
    }

    // Eğitimlerden kazanımların listesi
    public function educationsIndex()
    {
        $educations = Auth::user()->educations()->with('learnedEducations')->get();
        return view('learned.educations.index', compact('educations'));
        // Türkçe yorum: Kullanıcının eğitimlerinden elde ettiği kazanımlar listelenir.
    }

    // Yeni iş deneyimi kazanımı ekleme formu
    public function createExperience()
    {
        $experiences = Auth::user()->experiences;
        return view('learned.experiences.create', compact('experiences'));
        // Türkçe yorum: Yeni iş deneyimi kazanımı ekleme formunu gösterir.
    }

    // Yeni eğitim kazanımı ekleme formu
    public function createEducation()
    {
        $educations = Auth::user()->educations;
        return view('learned.educations.create', compact('educations'));
        // Türkçe yorum: Yeni eğitim kazanımı ekleme formunu gösterir.
    }

    // İş deneyimi kazanımı kaydetme
    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'experience_id' => 'required|exists:experiences,id',
            'description' => 'required|string|max:500',
            'activity_field' => 'nullable|string|max:150',
            'activity_tags' => 'nullable|array',
            'activity_tags.*' => 'string|max:50',
        ]);
        // Türkçe yorum: Etiketler virgülle ayrılmışsa diziye çevir
        $tags = $request->input('activity_tags');
        if (is_string($tags)) {
            $validated['activity_tags'] = array_filter(array_map('trim', explode(',', $tags)));
        } else {
            $validated['activity_tags'] = $tags ?? [];
        }
        $validated['description'] = \App\Services\Security\InputSanitizer::clean($validated['description']);
        $validated['activity_field'] = \App\Services\Security\InputSanitizer::clean($validated['activity_field']);
        if (is_array($validated['activity_tags'])) {
            $validated['activity_tags'] = array_map([\App\Services\Security\InputSanitizer::class, 'clean'], $validated['activity_tags']);
        }
        LearnedExperience::create($validated);
        return redirect()->route('learned.experiences.index')->with('success', 'Kazanım eklendi.');
        // Türkçe yorum: Yeni iş deneyimi kazanımı kaydedilir.
    }

    // Eğitim kazanımı kaydetme
    public function storeEducation(Request $request)
    {
        $validated = $request->validate([
            'education_id' => 'required|exists:educations,id',
            'core_learnings' => 'nullable|array',
            'core_learnings.*' => 'string|max:255',
            'general_learnings' => 'nullable|array',
            'general_learnings.*' => 'string|max:255',
        ]);
        // Türkçe yorum: Temel ve genel kazanımlar virgülle ayrılmışsa diziye çevir
        $core = $request->input('core_learnings');
        $general = $request->input('general_learnings');
        $validated['core_learnings'] = is_string($core) ? array_filter(array_map('trim', explode(',', $core))) : ($core ?? []);
        $validated['general_learnings'] = is_string($general) ? array_filter(array_map('trim', explode(',', $general))) : ($general ?? []);
        if (is_array($validated['core_learnings'])) {
            $validated['core_learnings'] = array_map([\App\Services\Security\InputSanitizer::class, 'clean'], $validated['core_learnings']);
        }
        if (is_array($validated['general_learnings'])) {
            $validated['general_learnings'] = array_map([\App\Services\Security\InputSanitizer::class, 'clean'], $validated['general_learnings']);
        }
        LearnedEducation::create($validated);
        return redirect()->route('learned.educations.index')->with('success', 'Kazanım eklendi.');
        // Türkçe yorum: Yeni eğitim kazanımı kaydedilir.
    }
} 