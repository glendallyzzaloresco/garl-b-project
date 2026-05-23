@extends('format.layout')

@section('title', 'Upload Image')

@section('content')
<style>
    .upload-page {
        max-width: 1080px;
        margin: 0 auto;
        padding: 32px 20px 48px;
    }

    .hero {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 24px;
        align-items: stretch;
        margin-bottom: 24px;
    }

    .hero-copy,
    .hero-panel,
    .form-card {
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(219, 227, 239, 0.9);
        box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
        backdrop-filter: blur(14px);
    }

    .hero-copy {
        border-radius: 28px;
        padding: 32px;
        position: relative;
        overflow: hidden;
    }

    .hero-copy::after {
        content: '';
        position: absolute;
        right: -80px;
        top: -80px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, transparent 70%);
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .hero-copy h1 {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3.6rem);
        line-height: 1.03;
        letter-spacing: -0.03em;
    }

    .hero-copy p {
        margin: 14px 0 0;
        max-width: 56ch;
        color: #6b7280;
        font-size: 15px;
        line-height: 1.7;
    }

    .hero-stats {
        margin-top: 24px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        position: relative;
        z-index: 1;
    }

    .stat {
        padding: 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.72);
        border: 1px solid rgba(219, 227, 239, 0.9);
    }

    .stat strong {
        display: block;
        font-size: 18px;
        margin-bottom: 4px;
    }

    .stat span {
        color: #6b7280;
        font-size: 13px;
    }

    .hero-panel {
        border-radius: 28px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 18px;
    }

    .preview-box {
        border-radius: 22px;
        border: 1.5px dashed rgba(37, 99, 235, 0.28);
        background: linear-gradient(180deg, rgba(37, 99, 235, 0.05), rgba(37, 99, 235, 0.01));
        min-height: 290px;
        display: grid;
        place-items: center;
        overflow: hidden;
        position: relative;
    }

    .preview-placeholder {
        text-align: center;
        color: #6b7280;
        padding: 28px;
    }

    .preview-placeholder i {
        font-size: 44px;
        color: #2563eb;
        margin-bottom: 12px;
        display: inline-block;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        display: none;
        object-fit: cover;
    }

    .form-card {
        border-radius: 28px;
        padding: 28px;
    }

    .flash,
    .errors {
        margin-bottom: 18px;
        border-radius: 18px;
        padding: 16px 18px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .flash.success {
        background: rgba(15, 157, 88, 0.08);
        border: 1px solid rgba(15, 157, 88, 0.18);
        color: #0f7a44;
    }

    .flash.error,
    .errors {
        background: rgba(220, 38, 38, 0.08);
        border: 1px solid rgba(220, 38, 38, 0.18);
        color: #991b1b;
    }

    .flash i,
    .errors i {
        font-size: 18px;
        margin-top: 2px;
    }

    .form-title {
        margin: 0 0 6px;
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
    }

    .form-subtitle {
        margin: 0 0 24px;
        color: #6b7280;
        font-size: 14px;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .field.full {
        grid-column: 1 / -1;
    }

    label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #415066;
    }

    .input,
    .textarea,
    .file-input {
        width: 100%;
        border-radius: 16px;
        border: 1.5px solid #dbe3ef;
        background: #fff;
        padding: 14px 16px;
        font: inherit;
        color: #162033;
        transition: all 0.2s ease;
    }

    .textarea {
        min-height: 150px;
        resize: vertical;
    }

    .input:focus,
    .textarea:focus,
    .file-input:focus {
        outline: none;
        border-color: rgba(37, 99, 235, 0.55);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .hint {
        color: #6b7280;
        font-size: 12px;
        line-height: 1.5;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #dbe3ef;
    }

    .btn {
        border: none;
        border-radius: 14px;
        padding: 13px 18px;
        font: inherit;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        text-decoration: none;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #eef2ff;
        color: #334155;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #fff;
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.22);
    }

    .btn-primary:hover {
        box-shadow: 0 16px 28px rgba(37, 99, 235, 0.28);
    }

    @media (max-width: 900px) {
        .hero {
            grid-template-columns: 1fr;
        }

        .hero-stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .upload-page {
            padding: 18px 14px 32px;
        }

        .form-card,
        .hero-copy,
        .hero-panel {
            border-radius: 22px;
        }

        .grid {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="upload-page">
    <div class="hero">
        

        <aside class="hero-panel">
            <div class="preview-box" id="previewBox">
                <div class="preview-placeholder" id="previewPlaceholder">
                    <i class="bi bi-image"></i>
                    <div>Image preview will appear here</div>
                    <div class="hint" style="margin-top: 8px;">Choose a JPG, PNG, or WebP file</div>
                </div>
                <img id="imagePreview" class="preview-image" alt="Selected image preview">
            </div>
            <div class="hint">
                Tip: keep the subject centered for the best crop after resizing.
            </div>
        </aside>
    </div>

    <section class="form-card">
        <h2 class="form-title">Upload New Post</h2>
        <p class="form-subtitle">Fill in the details below and submit the image to publish it.</p>

        @if (session('success'))
            <div class="flash success">
                <i class="bi bi-check-circle-fill"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="flash error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid">
                <div class="field full">
                    <label for="title">Post Title</label>
                    <input class="input" type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Enter a post title" required>
                </div>

                <div class="field full">
                    <label for="content">Post Content</label>
                    <textarea class="textarea" id="content" name="content" placeholder="Write a short description for the post" required>{{ old('content') }}</textarea>
                </div>

                <div class="field full">
                    <label for="image">Post Image</label>
                    <input class="file-input" type="file" id="image" name="image" accept="image/*" required>
                    <div class="hint">Recommended: square image for the cleanest display.</div>
                </div>
            </div>

            <div class="actions">
                <a class="btn btn-secondary" href="/dashboard">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-cloud-upload"></i>
                    Upload Post
                </button>
            </div>
        </form>
    </section>
</div>

<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewPlaceholder = document.getElementById('previewPlaceholder');

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            imagePreview.style.display = 'none';
            previewPlaceholder.style.display = 'block';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            imagePreview.src = event.target.result;
            imagePreview.style.display = 'block';
            previewPlaceholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection