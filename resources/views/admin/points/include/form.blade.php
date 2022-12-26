<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="stander-id">{{ __('Stander') }}</label>
            <select class="form-select @error('stander_id') is-invalid @enderror" name="stander_id" id="stander-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select stander') }} --</option>
                
                        @foreach ($standers as $stander)
                            <option value="{{ $stander->id }}" {{ isset($point) && $point->stander_id == $stander->id ? 'selected' : (old('stander_id') == $stander->id ? 'selected' : '') }}>
                                {{ $stander->name }}
                            </option>
                        @endforeach
            </select>
            @error('stander_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="rate-id">{{ __('Rate') }}</label>
            <select class="form-select @error('rate_id') is-invalid @enderror" name="rate_id" id="rate-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select rate') }} --</option>
                
                        @foreach ($rates as $rate)
                            <option value="{{ $rate->id }}" {{ isset($point) && $point->rate_id == $rate->id ? 'selected' : (old('rate_id') == $rate->id ? 'selected' : '') }}>
                                {{ $rate->user_id }}
                            </option>
                        @endforeach
            </select>
            @error('rate_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="point">{{ __('Points') }}</label>
            <input type="number" name="points" id="point" class="form-control @error('points') is-invalid @enderror" value="{{ isset($point) ? $point->points : old('points') }}" placeholder="{{ __('Points') }}" required />
            @error('points')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>