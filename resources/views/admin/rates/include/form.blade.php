<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="user-id">{{ __('User') }}</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($rate) && $rate->user_id == $user->id ? 'selected' : (old('user_id') == $user->id ? 'selected' : '') }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="by-id">{{ __('Sender') }}</label>
            <select class="form-select @error('by_id') is-invalid @enderror" name="by_id" id="by-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select sender') }} --</option>
                
                        @foreach ($senders as $sender)
                            <option value="{{ $sender->id }}" {{ isset($rate) && $rate->by_id == $sender->id ? 'selected' : (old('by_id') == $sender->id ? 'selected' : '') }}>
                                {{ $sender->id }} {{ $sender->name }}
                            </option>
                        @endforeach
            </select>
            @error('by_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="extra">{{ __('Extra') }}</label>
            <textarea name="extra" id="extra" class="form-control @error('extra') is-invalid @enderror" placeholder="{{ __('Extra') }}">{{ isset($rate) ? $rate->extra : old('extra') }}</textarea>
            @error('extra')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
	<div class="col-md-6">
	<p>Anonymous</p>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="anonymous" id="anonymous-1" value="1" {{ isset($rate) && $rate->anonymous == '1' ? 'checked' : (old('anonymous') == '1' ? 'checked' : '') }}>
                                    <label class="form-check-label" for="anonymous-1">True</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="anonymous" id="anonymous-0" value="0" {{ isset($rate) && $rate->anonymous == '0' ? 'checked' : (old('anonymous') == '0' ? 'checked' : '') }}>
                                    <label class="form-check-label" for="anonymous-0">False</label>
                                </div>
	</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="avg">{{ __('Avg') }}</label>
            <input type="number" name="avg" id="avg" class="form-control @error('avg') is-invalid @enderror" value="{{ isset($rate) ? $rate->avg : old('avg') }}" placeholder="{{ __('Avg') }}" required />
            @error('avg')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="request">{{ __('Request') }}</label>
            <input type="text" name="request" id="request" class="form-control @error('request') is-invalid @enderror" value="{{ isset($rate) ? $rate->request : old('request') }}" placeholder="{{ __('Request') }}" />
            @error('request')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>