<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"></div>
    <div class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="home-outline"></ion-icon>
            Dashboard
        </a>
        <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="settings-outline"></ion-icon>
            Settings
        </a>
        <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="person"></ion-icon>
            Users
        </a>
        <a href="{{ route('admin.manager.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="person"></ion-icon>
            Managers
        </a>
        <a href="{{ route('admin.tariff.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="cash"></ion-icon>
            Tariffs
        </a>
    </div>
</div>
<!-- /#sidebar-wrapper -->
