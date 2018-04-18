<div class="col-12 filter">
    <h2 class="text-center">Choose desired movies with this humble filter</h2>
    <form action="{{ route('filtered_list') }}" method="GET">
        <div class="row">
            <div class=" form-inline col-md-9 col-md-offset-3">
                <label for="date1">From</label>
                <input class="form-control" type="number" id="date1" name="date1" value="1900" min="1900" max="2050">
                <label for="date2">To</label>
                <input class="form-control" type="number" id="date2" name="date2" value="2018" min="1900" max="2050">
            </div>
            <div class=" form-inline col-md-12">
                <label for="genre">Genre</label>
                <select class="form-control" name="genre" id="genre">
                    <option value="">-</option>
                    <option value="action">Action</option>
                    <option value="drama">Drama</option>
                    <option value="adventure">Adventure</option>
                    <option value="anime">Anime</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="melodrama">Melodrama</option>
                    <option value="criminal">Criminal</option>
                    <option value="detective">Detective</option>
                    <option value="military">Military</option>
                    <option value="history">History</option>
                    <option value="horror">Horror</option>
                    <option value="thriller">Thriller</option>
                    <option value="comedy">Comedy</option>
                    <option value="music">Music</option>
                    <option value="biography">Biography</option>
                    <option value="sport">Sport</option>
                    <option value="fantastic">Fantastic</option>
                    <option value="western">Western</option>
                </select>
                <label for="director">Director</label>
                <select class="form-control" name="director" id="director">
                    <option value="">-</option>
                    <option value="ridley scott">Ridley Scott</option>
                    <option value="hayao miyazaki">Hayao Miyazaki</option>
                    <option value="peter jackson">Peter Jackson</option>
                </select>
                <label for="composer">Composer</label>
                <select class="form-control" name="composer" id="composer">
                    <option value="">-</option>
                    <option value="hans zimmer">Hans Zimmer</option>
                    <option value="joe hisaishi">Joe Hisaishi</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <input id="submit" class="form-control" type="submit" value="Filter">
        </div>
    </form>

    <script type="text/javascript">
        document.getElementById('genre').value = "{{ Request('genre') }}";
        document.getElementById('director').value = "{{ Request('director') }}";
        document.getElementById('date1').value = "{{ Request('date1') }}";
        document.getElementById('date2').value = "{{ Request('date2') }}";
        document.getElementById('composer').value = "{{ Request('composer') }}";
    </script>
</div>