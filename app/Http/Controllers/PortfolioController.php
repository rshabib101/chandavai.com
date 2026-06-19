<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProfile;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function show()
    {
        $portfolio = PortfolioProfile::firstOrCreateDefault();

        abort_unless($portfolio->is_published, 404);

        return view('frontend.portfolio', compact('portfolio'));
    }

    public function edit()
    {
        $portfolio = PortfolioProfile::firstOrCreateDefault();

        return view('admin.portfolio', [
            'portfolio' => $portfolio,
            'statsText' => $this->arrayToLines($portfolio->stats, ['value', 'label']),
            'servicesText' => $this->arrayToLines($portfolio->services, ['title', 'description']),
            'projectsText' => $this->arrayToLines($portfolio->projects, ['title', 'category', 'description']),
            'testimonialsText' => $this->arrayToLines($portfolio->testimonials, ['name', 'role', 'quote']),
            'skillsText' => implode("\n", $portfolio->skills ?? []),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'brand_name' => ['required', 'string', 'max:255'],
            'headline' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string'],
            'about' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'max:500'],
            'linkedin_url' => ['nullable', 'string', 'max:500'],
            'website_url' => ['nullable', 'string', 'max:500'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'cta_url' => ['nullable', 'string', 'max:500'],
            'stats_text' => ['nullable', 'string'],
            'services_text' => ['nullable', 'string'],
            'projects_text' => ['nullable', 'string'],
            'testimonials_text' => ['nullable', 'string'],
            'skills_text' => ['nullable', 'string'],
        ]);

        $portfolio = PortfolioProfile::firstOrCreateDefault();
        $portfolio->update([
            'brand_name' => $data['brand_name'],
            'headline' => $data['headline'],
            'tagline' => $data['tagline'] ?? null,
            'about' => $data['about'] ?? null,
            'hero_image' => $data['hero_image'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'facebook_url' => $data['facebook_url'] ?? null,
            'linkedin_url' => $data['linkedin_url'] ?? null,
            'website_url' => $data['website_url'] ?? null,
            'cta_text' => $data['cta_text'] ?: 'Start a Project',
            'cta_url' => $data['cta_url'] ?? null,
            'stats' => $this->linesToArray($data['stats_text'] ?? '', ['value', 'label']),
            'services' => $this->linesToArray($data['services_text'] ?? '', ['title', 'description']),
            'projects' => $this->linesToArray($data['projects_text'] ?? '', ['title', 'category', 'description']),
            'testimonials' => $this->linesToArray($data['testimonials_text'] ?? '', ['name', 'role', 'quote']),
            'skills' => $this->linesToList($data['skills_text'] ?? ''),
            'is_published' => $request->boolean('is_published'),
        ]);

        return back()->with('success', 'Portfolio updated successfully!');
    }

    private function linesToArray(string $text, array $keys): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) use ($keys) {
                $parts = array_map('trim', explode('|', $line));
                $item = [];

                foreach ($keys as $index => $key) {
                    $item[$key] = $parts[$index] ?? '';
                }

                return $item;
            })
            ->values()
            ->all();
    }

    private function linesToList(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function arrayToLines(?array $items, array $keys): string
    {
        return collect($items ?? [])
            ->map(fn ($item) => collect($keys)->map(fn ($key) => $item[$key] ?? '')->implode(' | '))
            ->implode("\n");
    }
}
