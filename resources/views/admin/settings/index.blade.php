@extends('admin.layouts.admin')
@section('title', 'Settings')
@section('page_title', 'Site Settings')
@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button">General</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="homepage-tab" data-bs-toggle="tab" data-bs-target="#homepage" type="button">Homepage</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button">Payment</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button">Shipping</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button">Social</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button">SEO</button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Site Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tagline</label>
                            <input type="text" name="tagline" class="form-control" value="{{ $settings['tagline'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            @if(!empty($settings['logo']))
                                <img src="{{ $settings['logo'] }}" class="mt-2 rounded" height="40">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Favicon</label>
                            <input type="file" name="favicon" class="form-control" accept="image/*">
                            @if(!empty($settings['favicon']))
                                <img src="{{ $settings['favicon'] }}" class="mt-2 rounded" height="32">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Phone</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Primary Color</label>
                            <input type="color" name="primary_color" class="form-control form-control-color" value="{{ $settings['primary_color'] ?? '#0D9488' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ $settings['meta_title'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control" value="{{ $settings['meta_description'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" value="{{ $settings['meta_keywords'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="homepage" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="show_flash_deals" value="1" class="form-check-input" {{ ($settings['show_flash_deals'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Flash Deals</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" name="show_featured" value="1" class="form-check-input" {{ ($settings['show_featured'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Featured Products</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" name="show_new_arrivals" value="1" class="form-check-input" {{ ($settings['show_new_arrivals'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Show New Arrivals</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="show_best_selling" value="1" class="form-check-input" {{ ($settings['show_best_selling'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Best Selling</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" name="show_category_showcase" value="1" class="form-check-input" {{ ($settings['show_category_showcase'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Category Showcase</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" name="show_brand_showcase" value="1" class="form-check-input" {{ ($settings['show_brand_showcase'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Brand Showcase</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Products Per Section</label>
                            <input type="number" name="products_per_section" class="form-control" value="{{ $settings['products_per_section'] ?? 10 }}">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="payment" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-check form-switch d-inline-block me-4">
                                <input type="checkbox" name="cod_enabled" value="1" class="form-check-input" {{ ($settings['cod_enabled'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Cash on Delivery</label>
                            </div>
                            <div class="form-check form-switch d-inline-block me-4">
                                <input type="checkbox" name="bkash_enabled" value="1" class="form-check-input" {{ ($settings['bkash_enabled'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">bKash</label>
                            </div>
                            <div class="form-check form-switch d-inline-block">
                                <input type="checkbox" name="nagad_enabled" value="1" class="form-check-input" {{ ($settings['nagad_enabled'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label">Nagad</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">bKash Number</label>
                            <input type="text" name="bkash_number" class="form-control" value="{{ $settings['bkash_number'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nagad Number</label>
                            <input type="text" name="nagad_number" class="form-control" value="{{ $settings['nagad_number'] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Payment Instructions</label>
                            <textarea name="payment_instructions" class="form-control" rows="4">{{ $settings['payment_instructions'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="shipping" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Inside Dhaka Charge (৳)</label>
                            <input type="number" step="0.01" name="inside_dhaka_charge" class="form-control" value="{{ $settings['inside_dhaka_charge'] ?? 60 }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Outside Dhaka Charge (৳)</label>
                            <input type="number" step="0.01" name="outside_dhaka_charge" class="form-control" value="{{ $settings['outside_dhaka_charge'] ?? 120 }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Free Delivery Above (৳)</label>
                            <input type="number" step="0.01" name="free_delivery_above" class="form-control" value="{{ $settings['free_delivery_above'] ?? 0 }}">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="social" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Facebook URL</label>
                            <input type="url" name="facebook_url" class="form-control" value="{{ $settings['facebook_url'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Twitter URL</label>
                            <input type="url" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instagram URL</label>
                            <input type="url" name="instagram_url" class="form-control" value="{{ $settings['instagram_url'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">YouTube URL</label>
                            <input type="url" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['whatsapp_number'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="seo" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Google Analytics ID</label>
                            <input type="text" name="google_analytics_id" class="form-control" value="{{ $settings['google_analytics_id'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Facebook Pixel ID</label>
                            <input type="text" name="facebook_pixel_id" class="form-control" value="{{ $settings['facebook_pixel_id'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save All Settings</button>
            </div>
        </div>
    </div>
</form>
@endsection
