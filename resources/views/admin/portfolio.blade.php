@extends('adminlte::page')

@section('title', 'Portfolio')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1>Portfolio Manager</h1>
        <a href="/portfolio" target="_blank" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-external-link-alt"></i> View Public Portfolio
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix these errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.portfolio.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Main Content</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Portfolio / Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" value="{{ old('brand_name', $portfolio->brand_name) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Headline</label>
                            <input type="text" name="headline" class="form-control" value="{{ old('headline', $portfolio->headline) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Short Tagline</label>
                            <textarea name="tagline" class="form-control" rows="3">{{ old('tagline', $portfolio->tagline) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>About</label>
                            <textarea name="about" class="form-control" rows="5">{{ old('about', $portfolio->about) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Hero Image URL</label>
                            <input type="text" name="hero_image" class="form-control" value="{{ old('hero_image', $portfolio->hero_image) }}">
                        </div>
                    </div>
                </div>

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Dynamic Sections</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Stats</label>
                            <small class="d-block text-muted mb-2">One per line: Value | Label</small>
                            <textarea name="stats_text" class="form-control" rows="4">{{ old('stats_text', $statsText) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Services</label>
                            <small class="d-block text-muted mb-2">One per line: Title | Description</small>
                            <textarea name="services_text" class="form-control" rows="6">{{ old('services_text', $servicesText) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Projects</label>
                            <small class="d-block text-muted mb-2">One per line: Title | Category | Description</small>
                            <textarea name="projects_text" class="form-control" rows="6">{{ old('projects_text', $projectsText) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Testimonials</label>
                            <small class="d-block text-muted mb-2">One per line: Name | Role | Quote</small>
                            <textarea name="testimonials_text" class="form-control" rows="5">{{ old('testimonials_text', $testimonialsText) }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label>Skills</label>
                            <small class="d-block text-muted mb-2">One skill per line</small>
                            <textarea name="skills_text" class="form-control" rows="5">{{ old('skills_text', $skillsText) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Contact & Links</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $portfolio->email) }}">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $portfolio->phone) }}">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $portfolio->address) }}">
                        </div>

                        <div class="form-group">
                            <label>Facebook URL</label>
                            <input type="text" name="facebook_url" class="form-control" value="{{ old('facebook_url', $portfolio->facebook_url) }}">
                        </div>

                        <div class="form-group">
                            <label>LinkedIn URL</label>
                            <input type="text" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $portfolio->linkedin_url) }}">
                        </div>

                        <div class="form-group">
                            <label>Website URL</label>
                            <input type="text" name="website_url" class="form-control" value="{{ old('website_url', $portfolio->website_url) }}">
                        </div>

                        <div class="form-group">
                            <label>CTA Button Text</label>
                            <input type="text" name="cta_text" class="form-control" value="{{ old('cta_text', $portfolio->cta_text) }}">
                        </div>

                        <div class="form-group">
                            <label>CTA Button URL</label>
                            <input type="text" name="cta_url" class="form-control" value="{{ old('cta_url', $portfolio->cta_url) }}">
                        </div>

                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_published" value="1" class="custom-control-input" id="is_published" @checked(old('is_published', $portfolio->is_published))>
                            <label class="custom-control-label" for="is_published">Published</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Save Portfolio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
