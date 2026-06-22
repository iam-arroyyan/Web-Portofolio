@props(['name' => 'image', 'label' => 'Gambar', 'required' => false, 'currentFile' => null, 'currentImage' => null, 'recommendedSize' => null, 'accept' => 'image/*', 'formatText' => null, 'icon' => 'fa-cloud-upload-alt', 'isAudio' => false])

<div class="form-group drag-drop-group">
    <label>{{ $label }} {!! $required ? '<span class="text-danger">*</span>' : '' !!}</label>
    
    <div class="drop-zone" id="drop-zone-{{ $name }}">
        <span class="drop-zone__prompt">
            <i class="fas {{ $icon }} drop-zone__icon"></i>
            <span class="drop-zone__title">Tarik & Lepas file ke sini, atau klik untuk mencari</span>
            <span class="drop-zone__subtitle">
                @if($formatText)
                    {!! $formatText !!}
                @elseif($recommendedSize)
                    Disarankan ukuran <strong>{{ $recommendedSize }}</strong> dan format <strong>.webp</strong>. (Maks 2MB)
                @else
                    Disarankan menggunakan format <strong>.webp</strong> agar website lebih ringan. (Maks 2MB)
                @endif
            </span>
        </span>
        <input type="file" name="{{ $name }}" class="drop-zone__input" id="input-{{ $name }}" accept="{{ $accept }}" {{ $required ? 'required' : '' }}>
        
        @if($currentImage)
            <div class="drop-zone__thumb" data-label="File Saat Ini" style="background-image: url('{{ Storage::url($currentImage) }}');"></div>
        @elseif($currentFile)
            <div class="drop-zone__thumb" data-label="{{ basename($currentFile) }}" style="background-color: #009578; display: flex; align-items: center; justify-content: center;"><i class="fas fa-file-audio" style="font-size: 3rem; color: white;"></i></div>
        @endif
    </div>
</div>
