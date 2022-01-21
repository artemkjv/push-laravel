<nav class="topbar-wrapper">
    <ul role="tablist" class="topbar">
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('moderator.edit', ['id' => $moderator->id]) }}">
                Apps
            </a>
        </li>
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('moderator.edit.segments', ['id' => $moderator->id]) }}">
                Segments
            </a>
        </li>
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('moderator.edit.templates', ['id' => $moderator->id]) }}">
                Templates
            </a>
        </li>
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('moderator.edit.customPushes', ['id' => $moderator->id]) }}">
                Custom Pushes
            </a>
        </li>
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('moderator.edit.autoPushes', ['id' => $moderator->id]) }}">
                Auto Pushes
            </a>
        </li>
        <li role="presentation">
            <a role="tab" class="non-underline" href="{{ route('moderator.edit.weeklyPushes', ['id' => $moderator->id]) }}">
                Weekly Pushes
            </a>
        </li>
    </ul>
</nav>
