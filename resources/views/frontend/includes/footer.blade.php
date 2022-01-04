<footer class="footer">
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="/">
                        {{ config('app.name', 'Sign Creators') }}
                    </a>
                </li>
                <!-- <li>
                    <a href="#">
                        About Us
                    </a>
                </li> -->
                
                @guest
                <li>
                    <a href="{{ route('frontend.auth.register') }}">
                        Register
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.auth.login') }}">
                        Login
                    </a>
                </li>
                @else
                <li>
                    <a href="#">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.auth.logout') }}">
                        Logout
                    </a>
                </li>
                @endguest
            </ul>
        </nav>
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> {{ 'Sign Creators' }} {!! setting('footer_text') !!}
        </div>
    </div>
</footer>
