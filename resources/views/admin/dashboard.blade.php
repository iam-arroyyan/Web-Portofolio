@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-grid">
    <div class="stat-card stat-sky">
        <div class="stat-icon">
            <i class="fas fa-briefcase"></i>
        </div>
        <div class="stat-body">
            <p class="stat-label">Portofolio</p>
            <p class="stat-value">{{ $counts['portfolios'] }}</p>
        </div>
    </div>
    <div class="stat-card stat-violet">
        <div class="stat-icon">
            <i class="fas fa-certificate"></i>
        </div>
        <div class="stat-body">
            <p class="stat-label">Sertifikat</p>
            <p class="stat-value">{{ $counts['certifications'] }}</p>
        </div>
    </div>
    <div class="stat-card stat-amber">
        <div class="stat-icon">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="stat-body">
            <p class="stat-label">Prestasi</p>
            <p class="stat-value">{{ $counts['achievements'] }}</p>
        </div>
    </div>
    <div class="stat-card stat-emerald">
        <div class="stat-icon">
            <i class="fas fa-images"></i>
        </div>
        <div class="stat-body">
            <p class="stat-label">Galeri</p>
            <p class="stat-value">{{ $counts['gallery'] }}</p>
        </div>
    </div>
    <div class="stat-card stat-rose">
        <div class="stat-icon">
            <i class="fas fa-address-book"></i>
        </div>
        <div class="stat-body">
            <p class="stat-label">Kontak</p>
            <p class="stat-value">{{ $counts['contacts'] }}</p>
        </div>
    </div>
</div>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-bolt text-accent"></i> Quick Actions</h2>
    </div>
    <div class="panel-body">
        <p style="margin-bottom: 1.5rem; color: var(--gray);">Akses cepat untuk menambah atau mengelola konten utama website.</p>
        
        <style>
            .quick-actions-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1rem;
            }
            .action-item {
                display: flex;
                align-items: center;
                gap: 0.8rem;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                text-decoration: none;
                color: var(--light);
                transition: all 0.3s ease;
            }
            .action-item:hover {
                background: rgba(37, 99, 235, 0.1);
                border-color: var(--secondary);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }
            .action-item i {
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 8px;
                color: var(--secondary);
                font-size: 1rem;
            }
            .action-label {
                font-size: 0.9rem;
                font-weight: 500;
            }
        </style>

        <div class="quick-actions-grid">
            <a href="{{ route('admin.portfolio.create') }}" class="action-item">
                <i class="fas fa-briefcase"></i>
                <span class="action-label">Tambah Portfolio</span>
            </a>
            <a href="{{ route('admin.certifications.create') }}" class="action-item">
                <i class="fas fa-certificate"></i>
                <span class="action-label">Tambah Sertifikat</span>
            </a>
            <a href="{{ route('admin.achievements.create') }}" class="action-item">
                <i class="fas fa-trophy"></i>
                <span class="action-label">Tambah Prestasi</span>
            </a>
            <a href="{{ route('admin.gallery.create') }}" class="action-item">
                <i class="fas fa-images"></i>
                <span class="action-label">Upload Galeri</span>
            </a>
            <a href="{{ route('admin.comments.index') }}" class="action-item">
                <i class="fas fa-comments"></i>
                <span class="action-label">Kelola Komentar</span>
            </a>
        </div>
    </div>
</div>
@endsection
