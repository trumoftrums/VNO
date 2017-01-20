/**
 * Created by LeeThong on 1/20/2017.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('value')
    }
});