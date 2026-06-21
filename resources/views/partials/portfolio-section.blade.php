
    <section class="portfolio" id="portfolio">
        <div class="container">
            <h2 class="section-title">Portofolio Proyek</h2>
            <div class="portfolio-grid">
                @if ($portfolios->isEmpty())
                    <p style="color: var(--gray); grid-column: 1 / -1;">Belum ada proyek portofolio.</p>
                @else
                    @foreach ($portfolios as $item)
                        <?php
                        $techItems = array_filter(array_map('trim', explode(',', $item['tech_stack'] ?? '')));
                        $projectLink = trim((string) ($item['project_link'] ?? ''));
                        $linkLabel = (strpos(strtolower($projectLink), 'github.com') !== false) ? 'GitHub Repo' : 'Lihat Proyek';
                        $imgAlt = preg_replace('/[\x{1F300}-\x{1F9FF}]/u', '', (string) $item['title']);
                        $imgAlt = trim($imgAlt) !== '' ? trim($imgAlt) : (string) $item['title'];
                        ?>
                <div class="portfolio-card">
                    <div class="portfolio-card-image">
                        <img src="{{ asset($item->image) }}" alt="{{ $imgAlt }}">
                    </div>
                    <div class="portfolio-card-body">
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['description'] }}</p>
                        @if ($techItems !== [])
                        <div class="tech-stack">
                            @foreach ($techItems as $tech)
                            <span>{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                        @if ($projectLink !== '')
                        <a href="{{ $projectLink }}" class="btn btn-outline"
                            style="font-size: 0.8rem; padding: 0.4rem 1.2rem; margin-top: 0.5rem;" target="_blank"
                            rel="noopener noreferrer">{{ $linkLabel }}</a>
                        @endif
                    </div>
                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
