
    
    <section class="gallery" id="gallery">
        <div class="container">
            <h2 class="section-title">Galeri Pencapaian</h2>
            <div class="gallery-grid">
                @if ($galleries->isEmpty())
                    <p style="color: var(--gray); grid-column: 1 / -1;">Belum ada foto galeri.</p>
                @else
                    @foreach ($galleries as $item)
                        <?php $imgPath = (string) $item['image']; ?>
                <div class="gallery-item">
                    <img src="{{ asset($imgPath) }}" alt="{{ basename($imgPath) }}">
                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
