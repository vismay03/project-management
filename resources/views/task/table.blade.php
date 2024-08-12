<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Total Task</th>
        </tr>
    </thead>
    <tbody id="show">

        @foreach ($projects as $project)
        <tr>

            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->tasks_count }}</td>
            <td class="action">
                <a href="{{ route('projects.edit', $project) }}" type="button" class="btn   btn-primary">Edit</a>

                <button  href="{{ route('projects.destroy', $project) }}"   type="button" id="delete"
                    class="btn  btn-danger">Delete</button>

            </td>
        </tr>

        @endforeach

    </tbody>
</table>

<div class="col-md-6">

    {{ $projects->links() }}
</div>
