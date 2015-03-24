            $(document).ready(function () {
                var newRowID = null;

                // prepare the data
                var source =
                        {
                            dataType: "tab",
                            dataFields: [
                                {name: "Id", type: "number"},
                                {name: "ParentID", type: "number"},
                                {name: "Population", type: "number"}
                            ],
                            hierarchy:
                                    {
                                        keyDataField: {name: 'Id'},
                                        parentDataField: {name: 'ParentID'}
                                    },
                            id: 'Id',
                                                       addRow: function (rowID, rowData, position, parentID, commit) {
                                // synchronize with the server - send insert command
                                // call commit with parameter true if the synchronization with the server is successful 
                                // and with parameter false if the synchronization failed.
                                // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                                commit(true);
                                newRowID = rowID;
                            },
                            updateRow: function (rowID, rowData, commit) {
                                // synchronize with the server - send update command
                                // call commit with parameter true if the synchronization with the server is successful 
                                // and with parameter false if the synchronization failed.
                                commit(true);
                            },
                            deleteRow: function (rowID, commit) {
                                // synchronize with the server - send delete command
                                // call commit with parameter true if the synchronization with the server is successful 
                                // and with parameter false if the synchronization failed.
                                commit(true);
                            }
                        };

                var dataAdapter = new $.jqx.dataAdapter(source, {
                    loadComplete: function () {
                        // data is loaded.
                    }
                });

                $("#treeGrid").jqxTreeGrid(
                        {
                            width: 850,
                            source: dataAdapter,
                            pageable: true,
                            editable: true,
                            showToolbar: true,
                            altRows: true,
                            ready: function ()
                            {
                                // called when the DatatreeGrid is loaded.         
                            },
                            pagerButtonsCount: 8,
                            toolbarHeight: 35,
                            renderToolbar: function (toolBar)
                            {
                                var toTheme = function (className) {
                                    if (theme == "")
                                        return className;
                                    return className + " " + className + "-" + theme;
                                }

                                // appends buttons to the status bar.
                                var container = $("<div style='overflow: hidden; position: relative; height: 100%; width: 100%;'></div>");
                                var buttonTemplate = "<div style='float: left; padding: 3px; margin: 2px;'><div style='margin: 4px; width: 16px; height: 16px;'></div></div>";
                                var addButton = $(buttonTemplate);
                                var editButton = $(buttonTemplate);
                                var deleteButton = $(buttonTemplate);
                                var cancelButton = $(buttonTemplate);
                                var updateButton = $(buttonTemplate);
                                container.append(addButton);
                                container.append(editButton);
                                container.append(deleteButton);
                                container.append(cancelButton);
                                container.append(updateButton);

                                toolBar.append(container);
                                addButton.jqxButton({cursor: "pointer", enableDefault: false, disabled: true, height: 25, width: 25});
                                addButton.find('div:first').addClass(toTheme('jqx-icon-plus'));
                                addButton.jqxTooltip({position: 'bottom', content: "Add"});

                                editButton.jqxButton({cursor: "pointer", disabled: true, enableDefault: false, height: 25, width: 25});
                                editButton.find('div:first').addClass(toTheme('jqx-icon-edit'));
                                editButton.jqxTooltip({position: 'bottom', content: "Edit"});

                                deleteButton.jqxButton({cursor: "pointer", disabled: true, enableDefault: false, height: 25, width: 25});
                                deleteButton.find('div:first').addClass(toTheme('jqx-icon-delete'));
                                deleteButton.jqxTooltip({position: 'bottom', content: "Delete"});

                                updateButton.jqxButton({cursor: "pointer", disabled: true, enableDefault: false, height: 25, width: 25});
                                updateButton.find('div:first').addClass(toTheme('jqx-icon-save'));
                                updateButton.jqxTooltip({position: 'bottom', content: "Save Changes"});

                                cancelButton.jqxButton({cursor: "pointer", disabled: true, enableDefault: false, height: 25, width: 25});
                                cancelButton.find('div:first').addClass(toTheme('jqx-icon-cancel'));
                                cancelButton.jqxTooltip({position: 'bottom', content: "Cancel"});

                                var updateButtons = function (action) {
                                    switch (action) {
                                        case "Select":
                                            addButton.jqxButton({disabled: false});
                                            deleteButton.jqxButton({disabled: false});
                                            editButton.jqxButton({disabled: false});
                                            cancelButton.jqxButton({disabled: true});
                                            updateButton.jqxButton({disabled: true});
                                            break;
                                        case "Unselect":
                                            addButton.jqxButton({disabled: true});
                                            deleteButton.jqxButton({disabled: true});
                                            editButton.jqxButton({disabled: true});
                                            cancelButton.jqxButton({disabled: true});
                                            updateButton.jqxButton({disabled: true});
                                            break;
                                        case "Edit":
                                            addButton.jqxButton({disabled: true});
                                            deleteButton.jqxButton({disabled: true});
                                            editButton.jqxButton({disabled: true});
                                            cancelButton.jqxButton({disabled: false});
                                            updateButton.jqxButton({disabled: false});
                                            break;
                                        case "End Edit":
                                            addButton.jqxButton({disabled: false});
                                            deleteButton.jqxButton({disabled: false});
                                            editButton.jqxButton({disabled: false});
                                            cancelButton.jqxButton({disabled: true});
                                            updateButton.jqxButton({disabled: true});
                                            break;

                                    }
                                }

                                var rowKey = null;
                                $("#treeGrid").on('rowSelect', function (event) {
                                    var args = event.args;
                                    rowKey = args.key;
                                    updateButtons('Select');
                                });
                                $("#treeGrid").on('rowUnselect', function (event) {
                                    updateButtons('Unselect');
                                });
                                $("#treeGrid").on('rowEndEdit', function (event) {
                                    updateButtons('End Edit');
                                });
                                $("#treeGrid").on('rowBeginEdit', function (event) {
                                    updateButtons('Edit');
                                });
                                addButton.click(function (event) {
                                    if (!addButton.jqxButton('disabled')) {
                                        $("#treeGrid").jqxTreeGrid('expandRow', rowKey);
                                        // add new empty row.
                                        $("#treeGrid").jqxTreeGrid('addRow', null, {}, 'first', rowKey);
                                        // select the first row and clear the selection.
                                        $("#treeGrid").jqxTreeGrid('clearSelection');
                                        $("#treeGrid").jqxTreeGrid('selectRow', newRowID);
                                        // edit the new row.
                                        $("#treeGrid").jqxTreeGrid('beginRowEdit', newRowID);
                                        updateButtons('add');
                                    }
                                });

                                cancelButton.click(function (event) {
                                    if (!cancelButton.jqxButton('disabled')) {
                                        // cancel changes.
                                        $("#treeGrid").jqxTreeGrid('endRowEdit', rowKey, true);
                                    }
                                });

                                updateButton.click(function (event) {
                                    if (!updateButton.jqxButton('disabled')) {
                                        // save changes.
                                        $("#treeGrid").jqxTreeGrid('endRowEdit', rowKey, false);
                                    }
                                });

                                editButton.click(function () {
                                    if (!editButton.jqxButton('disabled')) {
                                        $("#treeGrid").jqxTreeGrid('beginRowEdit', rowKey);
                                        updateButtons('edit');

                                    }
                                });
                                deleteButton.click(function () {
                                    if (!deleteButton.jqxButton('disabled')) {
                                        var selection = $("#treeGrid").jqxTreeGrid('getSelection');
                                        if (selection.length > 1) {
                                            var keys = new Array();
                                            for (var i = 0; i < selection.length; i++) {
                                                keys.push($("#treeGrid").jqxTreeGrid('getKey', selection[i]));
                                            }
                                            $("#treeGrid").jqxTreeGrid('deleteRow', keys);
                                        }
                                        else {
                                            $("#treeGrid").jqxTreeGrid('deleteRow', rowKey);
                                        }
                                        updateButtons('delete');

                                    }
                                });
                            },
                            columns: [
                                {text: 'Sede', dataField: "Name", align: 'center', width: '50%'},
                                {text: 'Population', dataField: "Population", align: 'right', cellsAlign: 'right', width: '50%'}
                            ]
                        });

                $('#jqxbutton').click(function () {
                    $("#treeGrid").jqxTreeGrid('addRow', null, {
                        FirstName: "Name",
                        LastName: "Last Name"
                    }, 'first')
                });

                $("#jqxbutton").jqxButton({
                    theme: 'energyblue',
                    width: 200,
                    height: 30
                });
            });

  