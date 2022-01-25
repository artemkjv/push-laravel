<nav class="topbar-wrapper">
    <ul role="tablist" class="topbar">
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('app.edit', ['id' => $app->id]) }}">
                Edit App
            </a>
        </li>
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('app.show', ['id' => $app->id]) }}">
                Show App
            </a>
        </li>
    </ul>
</nav>
