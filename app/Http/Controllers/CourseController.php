<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Giriş yapmış kullanıcının kurslarını, en yeniden eskiye doğru sıralayarak ve sayfalayarak alır.
        $courses = auth()->user()->courses()->latest()->paginate(10);

        // Kursları listeleme görünümünü döndürür.
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Yeni kurs oluşturma formunu gösteren görünümü döndürür.
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        // StoreCourseRequest ile doğrulanan verileri alır ve user_id ekler.
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        // Yeni kursu oluşturur.
        Course::create($validated);

        // Başarı mesajıyla birlikte kurs listeleme sayfasına yönlendirir.
        return redirect()->route('courses.index')->with('success', 'Kurs başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        // Bu projede tek bir kursu gösterme sayfası kullanılmayacaktır.
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course): View
    {
        // Kullanıcının bu kursu düzenleme yetkisi olup olmadığını kontrol eder.
        $this->authorize('update', $course);

        // Kurs düzenleme formunu, mevcut kurs verileriyle birlikte döndürür.
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCourseRequest $request, Course $course): RedirectResponse
    {
        // Kullanıcının bu kursu güncelleme yetkisi olup olmadığını kontrol eder.
        $this->authorize('update', $course);

        // StoreCourseRequest ile doğrulanan verileri alır.
        $validated = $request->validated();

        // Kursu günceller.
        $course->update($validated);

        // Başarı mesajıyla birlikte kurs listeleme sayfasına yönlendirir.
        return redirect()->route('courses.index')->with('success', 'Kurs başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        // Kullanıcının bu kursu silme yetkisi olup olmadığını kontrol eder.
        $this->authorize('delete', $course);

        // Kursu siler.
        $course->delete();

        // Başarı mesajıyla birlikte kurs listeleme sayfasına yönlendirir.
        return redirect()->route('courses.index')->with('success', 'Kurs başarıyla silindi.');
    }
}
