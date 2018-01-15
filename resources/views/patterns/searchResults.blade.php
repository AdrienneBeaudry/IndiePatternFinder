<ul class="pattern-grid">
    @if(count($patterns) === 0)
        <div class="no-result-container">
            <p class="no-result-message">No patterns found with this keyword. Please try again.</p>
        </div>
    @endif

    @foreach($patterns as $key => $value)
        <li class="pattern">
            <div class="pattern-container">
                <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                    <img src="{{ $value->image_url }}" class="pattern-img">
                </a>
                <button class="pattern-label"><strong>Designer #{{ $value->company_id }} </strong>
                    <br> <span class="pattern-name">{{ $value->name }}</span><br> {{ $value->price }}</button>
            </div>
        </li>
    @endforeach
</ul>