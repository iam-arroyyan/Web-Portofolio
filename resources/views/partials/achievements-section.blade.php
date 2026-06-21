
    
    <section class="achievements" id="achievements">
        <div class="container">
            <h2 class="section-title">Prestasi Unggulan</h2>

            @if ($achievements->isEmpty())
                <p style="color: var(--gray);">Belum ada data prestasi.</p>
            @else
                @foreach ($achievements as $item)
                    <?php
                    $imgPath = (string) $item['image'];
                    $imgAlt = basename($imgPath);
                    ?>
            <div class="achievement-card">
                <div class="achievement-photo">
                    <img src="{{ asset($imgPath) }}" alt="{{ $imgAlt }}">
                </div>
                <div class="achievement-info">
                    <h3>{{ $item['title'] }}</h3>
                    <p class="year">{{ $item['year'] }}</p>
                    <p>{{ $item['description'] }}</p>
                    <button type="button" class="btn btn-outline cert-btn"
                        onclick='openModal({!! json_encode(asset($imgPath), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!})'
                        style="font-size: 0.8rem; padding: 0.4rem 1.2rem; margin-top: 0.8rem;">
                        <i class="fas fa-eye"></i> Lihat Sertifikat
                    </button>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </section>
