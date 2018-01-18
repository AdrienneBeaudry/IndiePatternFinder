<ul class="pattern-grid">
    @if(count($patterns) === 0)
        <div class="no-result-container">
            <p class="no-result-message">No patterns found with this keyword. Please try again.</p>
        </div>
    @endif

    @foreach($patterns as $key => $value)
                <li class="pattern">
                    {{-- Default --}}
                    @if($value->company_id !== 3)
                        <div class="pattern-container">
                            <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                                <img src="{{ $value->image_url }}" class="pattern-img">
                    {{-- Special class for Pauline Alice Xerea Dress pattern--}}
                    @elseif($value->company_pattern_id == "3-38")
                        <div class="pattern-container-pauline-2">
                            <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                                <img src="{{ $value->image_url }}" class="pattern-img-pauline-2">
                    {{-- Pauline Alice Cami Dress pattern--}}
                    @elseif($value->company_pattern_id == "3-23" or $value->company_pattern_id == "3-34")
                        <div class="pattern-container-pauline-3">
                            <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                                <img src="{{ $value->image_url }}" class="pattern-img-pauline-3">
                    {{-- Pauline Alice Mirambell Skirt pattern--}}
                    @elseif($value->company_pattern_id == "3-45" or $value->company_pattern_id == "3-46")
                        <div class="pattern-container-pauline-4">
                            <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                                <img src="{{ $value->image_url }}" class="pattern-img-pauline-4">
                    {{-- All other Pauline Alice patterns --}}
                    @else
                        <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                            <div class="pattern-container-pauline-1">
                                <img src="{{ $value->image_url }}" class="pattern-img-pauline-1">
                    @endif
                        </a>
                        <button class="pattern-label"><strong>Designer #{{ $value->company_id }} </strong>
                            <br> <span class="pattern-name">{{ $value->name }}</span><br> {{ $value->price }}</button>
                    </div>
                </li>
    @endforeach
</ul>