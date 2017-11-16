(function($) {

    $.fn.kanban = function(options) {

       // defaults

        var $this = $(this);

        var settings = $.extend({
            titles: ['Block 1', 'Block 2', 'Block 3', 'Block 4'],
            colours: [],
            items: [],
            url: ""
        }, options)

        var classes = {
            kanban_board_class: "cd_kanban_board",
            kanban_board_titles_class: "cd_kanban_board_titles",
            kanban_board_title_class: "cd_kanban_board_title",
            kanban_board_blocks_class: "cd_kanban_board_blocks",
            kanban_board_block_class: "cd_kanban_board_block",
            kanban_board_item_class: "cd_kanban_board_block_item",
            kanban_board_item_placeholder_class: "cd_kanban_board_block_item_placeholder",
            kanban_board_item_title_class: "cd_kanban_board_block_item_title",
            kanban_board_item_footer_class: "cd_kanban_board_block_item_footer"
        };

        function build_kanban(){

            $this.addClass(classes.kanban_board_class);
            $this.append('<div class="'+classes.kanban_board_titles_class+'"></div>');
            $this.append('<div class="'+classes.kanban_board_blocks_class+'"></div>');

            build_titles();
            build_blocks();
            build_items();

        }

        function build_titles() {

            settings.titles.forEach(function (item, index, array) {
                var item = '<div style="background: '+settings.colours[index]+'" class="' + classes.kanban_board_title_class + '">' + '<p>'+item+'</p>' + '</div>';
                $this.find('.'+classes.kanban_board_titles_class).append(item);
            });

        }

        function build_blocks() {
            settings.titles.forEach(function (item, index, array) {
                var item = '<div class="' + classes.kanban_board_block_class + '" data-block="'+item+'"></div>';
                $this.find('.'+classes.kanban_board_blocks_class).append(item);
            });

            $( "."+classes.kanban_board_block_class ).sortable({
                connectWith: "."+classes.kanban_board_block_class,
                containment: "."+classes.kanban_board_blocks_class,
                placeholder: classes.kanban_board_item_placeholder_class,
                scroll: true,
                cursor: "move",
            }).disableSelection();

        }

        function build_items(){
            settings.items.forEach(function (item , index , array) {
                var block = $this.find('.'+classes.kanban_board_block_class+'[data-block="'+item.block+'"]');
                var append =  '<div class="'+classes.kanban_board_item_class+'" data-id="'+item.id+'">';
                        append += '<div class="'+classes.kanban_board_item_title_class+'">'+item.title+'</div>';

                        if(item.link){
                            append += '<a href="'+item.link+'">'+item.link_text+'</a>';
                        }

                        if(item.footer){
                            append += '<div class="'+classes.kanban_board_item_footer_class+'">'+item.footer+'</div>';
                        }

                    append += '</div>';



                block.append(append);
            });
        }

        if(settings.url){

            $('body').on( "sortstop" , "."+classes.kanban_board_block_class, function( event, ui ) {

                event.stopImmediatePropagation();

                var item = ui.item;
                var block = item.parents('.'+classes.kanban_board_block_class);

                var id = item[0].dataset.id;
                var block_name = block[0].dataset.block;

                var data = {'id': id , 'block': block_name, 'type': 'Kanban'};
                console.log(data);

                $.ajax({
                    url : settings.url,
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function () {
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });

            });

        }

        build_kanban();

    }

}(jQuery));