<nav style="background: white; position: fixed; top: 0; left: 0; right: 0; z-index: 1000; height: 80px; display: flex; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-bottom: 1px solid #e5e7eb;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; align-items: center; justify-content: space-between; width: 100%;">

        {{-- Logo + Site Name --}}
        <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
            @php $logoPath = \App\Models\PageSection::get('home','site','logo'); @endphp
            @if($logoPath)
            <img src="{{ Storage::url($logoPath) }}" alt="Haawwaa Galaan Logo"
                 style="height: 50px; width: auto; object-fit: contain;">
            @else
            <div style="width: 46px; height: 46px; background: #1e3a8a; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fas fa-landmark" style="color: white; font-size: 1.1rem;"></i>
            </div>
            @endif
            <span style="color: #1e3a8a; font-weight: 700; font-size: 1.1rem; letter-spacing: 1px;">HAAWWAA GALAAN</span>
        </a>

        {{-- Nav Links --}}
        <ul id="nav-menu" style="display: flex; list-style: none; margin: 0; padding: 0; gap: 5px;">
            <li>
                <a href="{{ route('home') }}"
                   style="color:{{ request()->routeIs('home') ? '#1e3a8a' : '#374151' }};text-decoration:none;font-weight:{{ request()->routeIs('home') ? '700' : '500' }};padding:8px 16px;border-radius:25px;transition:all 0.2s;{{ request()->routeIs('home') ? 'background:#eff6ff;' : '' }}font-size:0.95rem;">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ request()->routeIs('home') ? '#about' : route('home').'#about' }}"
                   style="color:#374151;text-decoration:none;font-weight:500;padding:8px 16px;border-radius:25px;transition:all 0.2s;font-size:0.95rem;">
                    About
                </a>
            </li>
            <li>
                <a href="{{ route('tourism') }}"
                   style="color:{{ request()->routeIs('tourism') ? '#1e3a8a' : '#374151' }};text-decoration:none;font-weight:{{ request()->routeIs('tourism') ? '700' : '500' }};padding:8px 16px;border-radius:25px;transition:all 0.2s;{{ request()->routeIs('tourism') ? 'background:#eff6ff;' : '' }}font-size:0.95rem;">
                    Tourism
                </a>
            </li>
            <li>
                <a href="{{ route('farming') }}"
                   style="color:{{ request()->routeIs('farming') ? '#1e3a8a' : '#374151' }};text-decoration:none;font-weight:{{ request()->routeIs('farming') ? '700' : '500' }};padding:8px 16px;border-radius:25px;transition:all 0.2s;{{ request()->routeIs('farming') ? 'background:#eff6ff;' : '' }}font-size:0.95rem;">
                    Farming
                </a>
            </li>
            <li>
                <a href="{{ request()->routeIs('home') ? '#contact' : route('home').'#contact' }}"
                   style="color:#374151;text-decoration:none;font-weight:500;padding:8px 16px;border-radius:25px;transition:all 0.2s;font-size:0.95rem;">
                    Contact
                </a>
            </li>
        </ul>

        {{-- Hamburger --}}
        <button id="hamburger" onclick="document.getElementById('nav-menu').classList.toggle('open')"
                style="display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:5px;">
            <span style="display:block;width:25px;height:3px;background:#374151;border-radius:3px;"></span>
            <span style="display:block;width:25px;height:3px;background:#374151;border-radius:3px;"></span>
            <span style="display:block;width:25px;height:3px;background:#374151;border-radius:3px;"></span>
        </button>
    </div>
</nav>

<style>
@media (max-width: 768px) {
    #hamburger { display: flex !important; }
    #nav-menu {
        display: none !important;
        position: fixed; top: 80px; left: 0; right: 0;
        background: white;
        flex-direction: column !important;
        padding: 15px 20px; gap: 5px !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        border-top: 1px solid #e5e7eb;
    }
    #nav-menu.open { display: flex !important; }
    #nav-menu a { color: #374151 !important; }
}
</style>
