@extends('admin.layouts.admin')
@section('title', 'Add Product')
@section('page_title', 'Add New Product')

@push('styles')
<style>
    .variant-row { background: #F8FAFC; padding: 15px; border-radius: 8px; margin-bottom: 10px; }
    .image-preview { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px dashed #E2E8F0; }
</style>
@endpush

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
@csrf
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h6 class="mb-0 fw-semibold">Basic Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Unit</label>
                        <input type="text" name="unit" class="form-control" value="{{ old('unit', 'pcs') }}" placeholder="pcs, kg, etc.">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Brand</label>
                        <select name="brand_id" class="form-select">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Regular Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="regular_price" class="form-control" value="{{ old('regular_price') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sale Price</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', 0) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Full Description</label>
                        <textarea name="full_description" id="summernote" class="form-control">{{ old('full_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header"><h6 class="mb-0 fw-semibold">Product Images</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*" onchange="previewThumbnail(this)">
                        <img id="thumbnail-preview" class="image-preview mt-2" style="display:none;">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Additional Images</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple onchange="previewImages(this)">
                        <div id="images-preview" class="d-flex gap-2 mt-2 flex-wrap"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Product Variants</h6>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addVariant()"><i class="fas fa-plus me-1"></i> Add Variant</button>
            </div>
            <div class="card-body" id="variants-container">
                <p class="text-muted small">Add variants like Size, Color, Material etc.</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header"><h6 class="mb-0 fw-semibold">SEO Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Meta Description</label>
                        <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h6 class="mb-0 fw-semibold">Product Status</h6></div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" name="status" value="1" class="form-check-input" checked>
                    <label class="form-check-label fw-medium">Published</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header"><h6 class="mb-0 fw-semibold">Product Flags</h6></div>
            <div class="card-body">
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" name="is_featured" value="1" class="form-check-input">
                    <label class="form-check-label">Featured</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" name="is_new_arrival" value="1" class="form-check-input">
                    <label class="form-check-label">New Arrival</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" name="is_best_selling" value="1" class="form-check-input">
                    <label class="form-check-label">Best Selling</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" name="is_flash_deal" value="1" class="form-check-input" id="flashDealCheck">
                    <label class="form-check-label">Flash Deal</label>
                </div>
                <div id="flashDealDate" style="display:none;" class="mt-2">
                    <label class="form-label">Flash Deal End Date</label>
                    <input type="datetime-local" name="flash_deal_end" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#summernote').summernote({ height: 250, toolbar: [['style',['bold','italic','underline','clear']],['para',['ul','ol','paragraph']],['insert',['link','picture']],['view',['codeview']]] });
    $('#flashDealCheck').change(function() { $('#flashDealDate').toggle(this.checked); });
});

function previewThumbnail(input) {
    if (input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#thumbnail-preview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function previewImages(input) {
    $('#images-preview').empty();
    for (let file of input.files) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#images-preview').append('<img src="'+e.target.result+'" class="image-preview">');
        }
        reader.readAsDataURL(file);
    }
}

let variantIndex = 0;
function addVariant() {
    variantIndex++;
    let html = '<div class="variant-row" id="variant-'+variantIndex+'">';
    html += '<div class="row g-2">';
    html += '<div class="col-md-3"><input type="text" name="variants['+variantIndex+'][type]" class="form-control form-control-sm" placeholder="Type (Size/Color)"></div>';
    html += '<div class="col-md-2"><input type="text" name="variants['+variantIndex+'][value]" class="form-control form-control-sm" placeholder="Value (L/Red)"></div>';
    html += '<div class="col-md-2"><input type="number" step="0.01" name="variants['+variantIndex+'][price]" class="form-control form-control-sm" placeholder="+Price" value="0"></div>';
    html += '<div class="col-md-2"><input type="number" name="variants['+variantIndex+'][stock]" class="form-control form-control-sm" placeholder="Stock" value="0"></div>';
    html += '<div class="col-md-2"><input type="text" name="variants['+variantIndex+'][sku]" class="form-control form-control-sm" placeholder="SKU"></div>';
    html += '<div class="col-md-1"><button type="button" class="btn btn-sm btn-danger" onclick="$(\'#variant-'+variantIndex+'\').remove()"><i class="fas fa-times"></i></button></div>';
    html += '</div></div>';
    $('#variants-container').append(html);
}
</script>
@endpush
