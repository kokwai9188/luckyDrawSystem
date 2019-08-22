@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="app1">
                        @if(empty($winners))
                            <el-alert title="Start to find the lucky one." type="success" :closable="false"></el-alert>
                        @else
                            <el-table :data="winners" style="width: 100%">
                                <el-table-column prop="name" label="Name" width="180"></el-table-column>
                                <el-table-column prop="number" label="Lucky Number"></el-table-column>
                                <el-table-column prop="created_at" label="Drawn Date"></el-table-column>
                            </el-table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- <script type="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/en-SG.js"></script> -->
    <script>
        // import moment from 'moment';

        console.log(<?php echo json_encode($winners) ?>);
        new Vue({
            el: '#app1',
            data: function() {
                return {
                    winners: <?php echo json_encode($winners) ?>
                }
            }
        })

        // Vue.filter('formatDate', function(value) {
        //     if (value) {
        //         return moment(String(value)).format('MM/DD/YYYY hh:mm')
        //     }
        // }
    </script>

@endsection
