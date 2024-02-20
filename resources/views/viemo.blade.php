<ul class="list-group">
    @foreach ($data as $i)
        @if (isset($i['metadata']['connections']['ancestor_path'][0]['name']))
            <ul class="list-group">
                <li> {{ $i['name'] }}</li>
            </ul>
        @else
            <li> {{ '   Main   ' . $i['name'] . '  -  -  -' . $i['uri'] }}</li>
        @endif
        {{-- @if (!isset($i['metadata']['connections']['parent_folder']['uri']))
            <li>
                {{  '   Main   '. $i['name'] . '  -  -  -' . $i['uri']  }}

            </li>
        @else
            <ul class="list-group">
                <li> {{ $i['name'] .   '    ' . $i['uri'] . '    '.  $i['metadata']['connections']['ancestor_path'][0]['name']}}</li>
            </ul>
        @endif --}}
    @endforeach
</ul>
