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
        <a href="{{ route('app.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="apps-outline"></ion-icon>
            Applications
        </a>
        <a href="{{ route('segment.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="pie-chart-outline"></ion-icon>
            Segments
        </a>
        <a href="{{ route('template.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="document-outline"></ion-icon>
            Templates
        </a>
        <a href="{{ route('pushUser.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="people-outline"></ion-icon>
            Push Users
        </a>
        <a href="{{ route('customPush.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="notifications-outline"></ion-icon>
            Custom Pushes
        </a>
        <a href="{{ route('weeklyPush.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="notifications-outline"></ion-icon>
            Weekly Pushes
        </a>
        <a href="{{ route('autoPush.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="notifications-outline"></ion-icon>
            Auto Pushes
        </a>
        <a href="{{ route('sentPush.index') }}" class="list-group-item list-group-item-action bg-light">
            <ion-icon name="stats-chart-outline"></ion-icon>
            Delivery
        </a>
    </div>
</div>
<!-- /#sidebar-wrapper -->
