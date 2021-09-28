<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">Start Bootstrap</div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('admin.services.index')}}">Services</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('admin.team.index')}}">Team</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('admin.settings.edit', ['setting' => 1])}}">Settings</a>
    </div>
</div>
