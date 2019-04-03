/**
 * Created by GX on 2017-02-20.
 */
function addMoodMessage() {
            $.post(c_path + '/findInfoById', {'data': $('#form_data').serialize()}, function (result) {
                if (result.code == '500') {
                    $.each(result.data, function (key, value) {
                        if (key == 'is_enable') {
                            $('input[name="' + key + '"][value="' + value + '"]').prop("checked", true);
                            return;
                        }
                        $('#' + key).val(value);
                    });
                }
            }, 'json');
        }
    });
}

