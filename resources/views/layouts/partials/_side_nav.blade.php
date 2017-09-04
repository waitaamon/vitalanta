<div class="sidebar" data-color="purple" data-image="/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('homepage') }}" class="simple-text">
                Vitalanta Inc
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="">
                <a href="{{ route('upload.index') }}">
                    <i class="pe-7s-plus"></i>
                    <p>New Post</p>
                </a>
            </li>
            <li>
                <a href="{{ route('show.uploads') }}">
                    <i class="pe-7s-portfolio"></i>
                    <p>Previous Posts</p>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.show', $channel) }}">
                    <i class="pe-7s-user"></i>
                    <p>Your Profile</p>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit', $channel) }}">
                    <i class="pe-7s-tools"></i>
                    <p>Edit Profile</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="pe-7s-bell"></i>
                    <p>Notifications</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="pe-7s-rocket"></i>
                    <p>Upgrated to pro</p>
                </a>
            </li>

        </ul>
    </div>
</div>