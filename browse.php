<?php include 'templates/header.php';?>

    <body>
    <?php include 'templates/navbar.php';?>

    <div id="browse">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Browse</h1>

                    <h2>Find a movie and display its ratings</h2>
                    <p>To use wildcards - add a percent sign at the beginning or end or your search term to include any text</p>
                    <p>For example: &quot;%alien&quot; will give you any movie that ends in &quot;alien&quot;. &quot;alien%&quot; will give you any movie that starts with &quot;alien&quot;.</p><br/>

                    <div class="form-group">
                        <label class="mylabel-box">
                            <button onClick="browseSearch()">Search for:</button>
                        </label>
                        <input type="text" id="mname" class="myform-control" />

                        <select class="select2-browse-search"  style="width: 150px;">
                        </select>
                    </div>
                    <br />

                    <table class="table table-striped table-hover" id="browseTable">
                        <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th>Year</th>
                            <th>Rating</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <!-- this is where we show any messages - like more than 25 results found -->
                    <div id="browseMsg"></div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            // this function sends ajax requests for remote movie search
            $('.select2-browse-search').select2({
                placeholder: 'Select movie here...',
                ajax: {

                    url: 'dt.php',
                    type: 'POST',
                    dataType: 'json',

                    delay: 250,


                    data: function (params) {
                        return JSON.stringify({
                            "action": "remoteBrowse",
                            "target": $.trim(params.term)
                        });
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                if(!item.id) return
                                return { text: item.name, id: item.id }
                            })
                        };

                    },

                    cache: false
                },

            });
            // show selected movie from remote search select2  in table
            $('.select2-browse-search').on('change', function() {
                placeholder: 'Search for movies..'
                var data = $(".select2-browse-search option:selected").text();
                remoteBrowseSearch();
            })
        });


    </script>
    </body>

<?php include 'templates/footer.php';?>
