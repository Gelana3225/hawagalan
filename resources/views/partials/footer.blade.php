<footer style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); color: white; padding: 60px 0 30px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <div>
                <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 15px;">@hawwaa_galaan</h3>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.7;">
                    Biyya Aannanii fi Bunaa waa maraan badhaate!<br>
                    Kottaa waliin hojjennee, waliin guddanna!
                </p>
            </div>
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 15px;">Quick Links</h3>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <li><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;">Home</a></li>
                    <li><a href="{{ route('farming') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;">Farming</a></li>
                    <li><a href="{{ route('tourism') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;">Tourism</a></li>
                    <li><a href="{{ route('biography') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;">Biography</a></li>
                </ul>
            </div>
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 15px;">Contact</h3>
                <div style="display: flex; flex-direction: column; gap: 10px; color: rgba(255,255,255,0.8);">
                    @if(isset($contact) && $contact->isNotEmpty())
                        @if($contact->has('address'))
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-map-marker-alt" style="margin-top: 3px; color: #93c5fd;"></i>
                            <span>{{ $contact['address'] }}</span>
                        </div>
                        @endif
                        @if($contact->has('phone'))
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-phone" style="color: #93c5fd;"></i>
                            <span>{{ $contact['phone'] }}</span>
                        </div>
                        @endif
                        @if($contact->has('email'))
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-envelope" style="color: #93c5fd;"></i>
                            <span>{{ $contact['email'] }}</span>
                        </div>
                        @endif
                    @else
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-map-marker-alt" style="margin-top: 3px; color: #93c5fd;"></i>
                            <span>Gabaa Roobii, Aanaa Haawwaa Galaan, Qellem Wallaggaa</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; color: rgba(255,255,255,0.6); font-size: 0.9rem;">
            <p style="margin: 0;">&copy; {{ date('Y') }} Haawwaa Galaan. All rights reserved.</p>
            @auth
                <a href="{{ route('admin.dashboard') }}" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 0.8rem; transition: color 0.2s;" onmouseover="this.style.color='rgba(255,255,255,0.9)'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">
                    <i class="fas fa-cog"></i> Admin Panel
                </a>
            @else
                <a href="{{ route('login') }}" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 0.8rem; transition: color 0.2s;" onmouseover="this.style.color='rgba(255,255,255,0.9)'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">
                    <i class="fas fa-lock"></i> Admin Login
                </a>
            @endauth
        </div>
    </div>
</footer>

