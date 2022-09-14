(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["user-user-module"],{

/***/ "./src/app/user/components/role/permission/permission.component.html":
/*!***************************************************************************!*\
  !*** ./src/app/user/components/role/permission/permission.component.html ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n<div class=\"w3-block\">\n  <div class=\"w3-white material-shadow safe-box\">\n    <div class=\"safe-box-header w3-large\" style=\"padding: 5px!important\">\n      {{ \"permissions\" | trans }} <i class=\"fa fa-angle-left\" ></i> {{ role.name }}\n    </div>\n    <div class=\"border-bottom-dashed\"></div>\n    <br>\n\n    <div class=\"row\">\n\n      <div class=\"col-lg-4 col-md-4 col-sm-4\" *ngFor=\"let group of groups\" >\n        <div class=\"custom-panel w3-display-container w3-round application-panel student-info-panel group-{{ group.id }}\">\n          <div class=\"custom-panel-title\">\n            <mat-slide-toggle\n                      #selectAllMatSlider\n                      (change)=\"selectAll(group, selectAllMatSlider.checked)\" ></mat-slide-toggle>\n                      {{ group.name }}\n          </div>\n          <div class=\"custom-panel-body table-responsive w3-padding w3-center\" style=\"height: 400px;\" >\n            <br>\n            <ul class=\"w3-ul\">\n              <li *ngFor=\"let item of group.permissions\" >\n                <div class=\"media\">\n                  <div class=\"media-left\">\n                    <mat-slide-toggle\n                      [checked]=\"permissionId.has(item.id)\"\n                      (change)=\"togglePermissions(item.id)\" ></mat-slide-toggle>\n                  </div>\n                  <div class=\"media-body\">\n                    <div class=\"media-heading text-right \">{{ item.display_name }}</div>\n                  </div>\n                </div>\n              </li>\n             </ul>\n          </div>\n\n\n        </div>\n      </div>\n\n    </div>\n    <div class=\"box-footer\">\n      <button [disabled]=\"isSubmitted\" (click)=\"updatePermissions()\" type=\"submit\" class=\"btn btn-primary\">\n        <i *ngIf=\"!isSubmitted\" >{{ \"add\" | trans }}</i>\n        <i *ngIf=\"isSubmitted\" class=\"fa fa-spin fa-spinner\" ></i>\n      </button>\n\n    </div>\n\n\n  </div>\n</div>\n\n"

/***/ }),

/***/ "./src/app/user/components/role/permission/permission.component.scss":
/*!***************************************************************************!*\
  !*** ./src/app/user/components/role/permission/permission.component.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ".safe-box {\n  padding: 10px;\n}\n\n.border-bottom-dashed {\n  border-bottom: 2px dashed gray !important;\n}\n\n.border-bottom-red {\n  border-bottom: 2px dashed red !important;\n}\n\n.border-dashed {\n  border: 2px dashed lightgray !important;\n}\n\n.btn-margin-bottom {\n  margin-bottom: 6px !important;\n}\n\n.custom-panel {\n  border: 2px dashed lightgray !important;\n  margin-bottom: 15px !important;\n}\n\n.custom-panel-title {\n  position: absolute !important;\n  right: 10px !important;\n  top: -13px !important;\n  width: auto !important;\n  background-color: white !important;\n  padding-left: 10px !important;\n  padding-right: 10px !important;\n  z-index: 9999999;\n}\n\n.custom-panel-body {\n  padding: 5px;\n}\n\n.small-shadow {\n  box-shadow: 0 1px 1px 0px rgba(0, 0, 0, 0.3) !important;\n}\n\n.search-input {\n  min-width: 70% !important;\n}\n\n.border-gray {\n  border: 1px solid gray !important;\n}\n\n.custom-input {\n  min-width: 120px;\n}\n\n.modal {\n  overflow: auto !important;\n}\n\n/*\n  custom button style\n*/\n\nselect, input[type=file] {\n  padding: 0px !important;\n}\n\n.filter-top {\n  height: 200px !important;\n  overflow: auto;\n}\n\n.filter-side {\n  height: 400px !important;\n  overflow: auto;\n}\n\n.w3-ul li {\n  padding: 2px !important;\n  font-size: 12px !important;\n}\n\n.number_input {\n  width: 45px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIi9tZWRpYS9tb2hhbWVkLzZDMzJFOEZFMzJFOENERTAvcHJvamVjdHMvSElNLUZyb250L3NyYy9hcHAvdXNlci9jb21wb25lbnRzL3JvbGUvcGVybWlzc2lvbi9wZXJtaXNzaW9uLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC91c2VyL2NvbXBvbmVudHMvcm9sZS9wZXJtaXNzaW9uL3Blcm1pc3Npb24uY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7RUFDRSxhQUFBO0FDQ0Y7O0FERUE7RUFDRSx5Q0FBQTtBQ0NGOztBREVBO0VBQ0Usd0NBQUE7QUNDRjs7QURFQTtFQUNFLHVDQUFBO0FDQ0Y7O0FERUE7RUFDRSw2QkFBQTtBQ0NGOztBREVBO0VBQ0UsdUNBQUE7RUFDQSw4QkFBQTtBQ0NGOztBREdBO0VBQ0UsNkJBQUE7RUFDQSxzQkFBQTtFQUNBLHFCQUFBO0VBQ0Esc0JBQUE7RUFDQSxrQ0FBQTtFQUNBLDZCQUFBO0VBQ0EsOEJBQUE7RUFDQSxnQkFBQTtBQ0FGOztBREdBO0VBQ0UsWUFBQTtBQ0FGOztBREdBO0VBQ0UsdURBQUE7QUNBRjs7QURHQTtFQUNFLHlCQUFBO0FDQUY7O0FER0E7RUFDRSxpQ0FBQTtBQ0FGOztBREdBO0VBQ0UsZ0JBQUE7QUNBRjs7QURHQTtFQUNFLHlCQUFBO0FDQUY7O0FERUE7O0NBQUE7O0FBSUE7RUFDRSx1QkFBQTtBQ0FGOztBREdBO0VBQ0Usd0JBQUE7RUFDQSxjQUFBO0FDQUY7O0FER0E7RUFDRSx3QkFBQTtFQUNBLGNBQUE7QUNBRjs7QURJQTtFQUNFLHVCQUFBO0VBQ0EsMEJBQUE7QUNERjs7QURJQTtFQUNFLFdBQUE7QUNERiIsImZpbGUiOiJzcmMvYXBwL3VzZXIvY29tcG9uZW50cy9yb2xlL3Blcm1pc3Npb24vcGVybWlzc2lvbi5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIi5zYWZlLWJveCB7XG4gIHBhZGRpbmc6IDEwcHhcbn1cblxuLmJvcmRlci1ib3R0b20tZGFzaGVkIHtcbiAgYm9yZGVyLWJvdHRvbTogMnB4IGRhc2hlZCBncmF5IWltcG9ydGFudDtcbn1cblxuLmJvcmRlci1ib3R0b20tcmVkIHtcbiAgYm9yZGVyLWJvdHRvbTogMnB4IGRhc2hlZCByZWQhaW1wb3J0YW50O1xufVxuXG4uYm9yZGVyLWRhc2hlZCB7XG4gIGJvcmRlcjogMnB4IGRhc2hlZCBsaWdodGdyYXkhaW1wb3J0YW50O1xufVxuXG4uYnRuLW1hcmdpbi1ib3R0b20ge1xuICBtYXJnaW4tYm90dG9tOiA2cHghaW1wb3J0YW50O1xufVxuXG4uY3VzdG9tLXBhbmVsIHtcbiAgYm9yZGVyOiAycHggZGFzaGVkIGxpZ2h0Z3JheSFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDE1cHghaW1wb3J0YW50O1xufVxuXG5cbi5jdXN0b20tcGFuZWwtdGl0bGUge1xuICBwb3NpdGlvbjogYWJzb2x1dGUhaW1wb3J0YW50O1xuICByaWdodDogMTBweCFpbXBvcnRhbnQ7XG4gIHRvcDogLTEzcHghaW1wb3J0YW50O1xuICB3aWR0aDogYXV0byFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6IHdoaXRlIWltcG9ydGFudDtcbiAgcGFkZGluZy1sZWZ0OiAxMHB4IWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTBweCFpbXBvcnRhbnQ7XG4gIHotaW5kZXg6IDk5OTk5OTk7XG59XG5cbi5jdXN0b20tcGFuZWwtYm9keSB7XG4gIHBhZGRpbmc6IDVweDtcbn1cblxuLnNtYWxsLXNoYWRvdyB7XG4gIGJveC1zaGFkb3c6IDAgMXB4IDFweCAwcHggcmdiYSgwLDAsMCwwLjMpIWltcG9ydGFudDtcbn1cblxuLnNlYXJjaC1pbnB1dCB7XG4gIG1pbi13aWR0aDogNzAlIWltcG9ydGFudDtcbn1cblxuLmJvcmRlci1ncmF5IHtcbiAgYm9yZGVyOiAxcHggc29saWQgZ3JheSFpbXBvcnRhbnQ7XG59XG5cbi5jdXN0b20taW5wdXQge1xuICBtaW4td2lkdGg6IDEyMHB4XG59XG5cbi5tb2RhbCB7XG4gIG92ZXJmbG93OiBhdXRvIWltcG9ydGFudDtcbn1cbi8qXG4gIGN1c3RvbSBidXR0b24gc3R5bGVcbiovXG5cbnNlbGVjdCwgaW5wdXRbdHlwZT1maWxlXSB7XG4gIHBhZGRpbmc6IDBweCFpbXBvcnRhbnQ7XG59XG5cbi5maWx0ZXItdG9wIHtcbiAgaGVpZ2h0OiAyMDBweCFpbXBvcnRhbnQ7XG4gIG92ZXJmbG93OiBhdXRvO1xufVxuXG4uZmlsdGVyLXNpZGUge1xuICBoZWlnaHQ6IDQwMHB4IWltcG9ydGFudDtcbiAgb3ZlcmZsb3c6IGF1dG87XG59XG5cblxuLnczLXVsIGxpIHtcbiAgcGFkZGluZzogMnB4IWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxMnB4IWltcG9ydGFudDtcbn1cblxuLm51bWJlcl9pbnB1dCB7XG4gIHdpZHRoOiA0NXB4XG59XG4iLCIuc2FmZS1ib3gge1xuICBwYWRkaW5nOiAxMHB4O1xufVxuXG4uYm9yZGVyLWJvdHRvbS1kYXNoZWQge1xuICBib3JkZXItYm90dG9tOiAycHggZGFzaGVkIGdyYXkgIWltcG9ydGFudDtcbn1cblxuLmJvcmRlci1ib3R0b20tcmVkIHtcbiAgYm9yZGVyLWJvdHRvbTogMnB4IGRhc2hlZCByZWQgIWltcG9ydGFudDtcbn1cblxuLmJvcmRlci1kYXNoZWQge1xuICBib3JkZXI6IDJweCBkYXNoZWQgbGlnaHRncmF5ICFpbXBvcnRhbnQ7XG59XG5cbi5idG4tbWFyZ2luLWJvdHRvbSB7XG4gIG1hcmdpbi1ib3R0b206IDZweCAhaW1wb3J0YW50O1xufVxuXG4uY3VzdG9tLXBhbmVsIHtcbiAgYm9yZGVyOiAycHggZGFzaGVkIGxpZ2h0Z3JheSAhaW1wb3J0YW50O1xuICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XG59XG5cbi5jdXN0b20tcGFuZWwtdGl0bGUge1xuICBwb3NpdGlvbjogYWJzb2x1dGUgIWltcG9ydGFudDtcbiAgcmlnaHQ6IDEwcHggIWltcG9ydGFudDtcbiAgdG9wOiAtMTNweCAhaW1wb3J0YW50O1xuICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiB3aGl0ZSAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTBweCAhaW1wb3J0YW50O1xuICB6LWluZGV4OiA5OTk5OTk5O1xufVxuXG4uY3VzdG9tLXBhbmVsLWJvZHkge1xuICBwYWRkaW5nOiA1cHg7XG59XG5cbi5zbWFsbC1zaGFkb3cge1xuICBib3gtc2hhZG93OiAwIDFweCAxcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4zKSAhaW1wb3J0YW50O1xufVxuXG4uc2VhcmNoLWlucHV0IHtcbiAgbWluLXdpZHRoOiA3MCUgIWltcG9ydGFudDtcbn1cblxuLmJvcmRlci1ncmF5IHtcbiAgYm9yZGVyOiAxcHggc29saWQgZ3JheSAhaW1wb3J0YW50O1xufVxuXG4uY3VzdG9tLWlucHV0IHtcbiAgbWluLXdpZHRoOiAxMjBweDtcbn1cblxuLm1vZGFsIHtcbiAgb3ZlcmZsb3c6IGF1dG8gIWltcG9ydGFudDtcbn1cblxuLypcbiAgY3VzdG9tIGJ1dHRvbiBzdHlsZVxuKi9cbnNlbGVjdCwgaW5wdXRbdHlwZT1maWxlXSB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuXG4uZmlsdGVyLXRvcCB7XG4gIGhlaWdodDogMjAwcHggIWltcG9ydGFudDtcbiAgb3ZlcmZsb3c6IGF1dG87XG59XG5cbi5maWx0ZXItc2lkZSB7XG4gIGhlaWdodDogNDAwcHggIWltcG9ydGFudDtcbiAgb3ZlcmZsb3c6IGF1dG87XG59XG5cbi53My11bCBsaSB7XG4gIHBhZGRpbmc6IDJweCAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDEycHggIWltcG9ydGFudDtcbn1cblxuLm51bWJlcl9pbnB1dCB7XG4gIHdpZHRoOiA0NXB4O1xufSJdfQ== */"

/***/ }),

/***/ "./src/app/user/components/role/permission/permission.component.ts":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/role/permission/permission.component.ts ***!
  \*************************************************************************/
/*! exports provided: PermissionComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PermissionComponent", function() { return PermissionComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var angular_hashtable__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! angular-hashtable */ "./node_modules/angular-hashtable/fesm2015/angular-hashtable.js");
/* harmony import */ var src_app_shared_message__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! src/app/shared/message */ "./src/app/shared/message.ts");
/* harmony import */ var _services_role_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../services/role.service */ "./src/app/user/services/role.service.ts");





let PermissionComponent = class PermissionComponent {
    constructor(service) {
        this.service = service;
        this.role = {};
        this.updateMode = false;
        this.loadResources = false;
        this.doc = document;
        this.$ = $;
        this.permissions = [];
        this.permissionId = new angular_hashtable__WEBPACK_IMPORTED_MODULE_2__["HashTable"]();
        this.groups = [];
        this.isSubmitted = false;
    }
    setPermission() {
        this.permissionId = new angular_hashtable__WEBPACK_IMPORTED_MODULE_2__["HashTable"]();
        if (!this.role)
            return;
        if (!this.role.permissions)
            return;
        this.role.permissions.forEach(element => {
            this.permissionId.put(element.id, element.id);
        });
    }
    updatePermissions() {
        this.isSubmitted = true;
        let data = {
            permissions: this.permissionId.getKeys()
        };
        this.service.updatePermission(this.role.id, data).subscribe((res) => {
            if (res.status == 1) {
                src_app_shared_message__WEBPACK_IMPORTED_MODULE_3__["Message"].success(res.message);
                this.loadResources();
            }
            else
                src_app_shared_message__WEBPACK_IMPORTED_MODULE_3__["Message"].error(res.message);
            this.isSubmitted = false;
        });
    }
    togglePermissions(id) {
        if (this.permissionId.has(id))
            this.permissionId.remove(id);
        else
            this.permissionId.put(id, id);
        this.updatePermissions();
    }
    loadPermissions() {
        this.service.permissions().subscribe((res) => {
            this.permissions = res;
        });
    }
    loadGroups() {
        this.service.groups().subscribe((res) => {
            this.groups = res;
        });
    }
    ngOnInit() {
        this.loadPermissions();
        this.loadGroups();
    }
    ngOnChanges() {
        this.setPermission();
    }
    selectAll(group, checked) {
        group.permissions.forEach(element => {
            if (checked)
                this.permissionId.put(element.id, element.id);
            else if (this.permissionId.has(element.id))
                this.permissionId.remove(element.id);
        });
        this.updatePermissions();
    }
    changeMode() {
        this.updateMode = false;
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], PermissionComponent.prototype, "role", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], PermissionComponent.prototype, "updateMode", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], PermissionComponent.prototype, "loadResources", void 0);
PermissionComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-permission',
        template: __webpack_require__(/*! ./permission.component.html */ "./src/app/user/components/role/permission/permission.component.html"),
        styles: [__webpack_require__(/*! ./permission.component.scss */ "./src/app/user/components/role/permission/permission.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_role_service__WEBPACK_IMPORTED_MODULE_4__["RoleService"]])
], PermissionComponent);



/***/ }),

/***/ "./src/app/user/components/role/role-form/role-form.component.html":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/role/role-form/role-form.component.html ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n<!-- form modal -->\n<div class=\"modal fade\" id=\"{{ isUpdate? 'update' : 'create' }}Modal\" role=\"dialog\">\n  <div class=\"modal-dialog\" role=\"document\">\n    <div class=\"modal-content\">\n      <div class=\"modal-header\">\n        <h4 class=\"modal-title\">\n          <span *ngIf=\"isUpdate\" >{{ \"edit role\" | trans }}</span>\n          <span *ngIf=\"!isUpdate\" >{{ \"add role\" | trans }}</span>\n\n        </h4>\n      </div>\n      <div class=\"modal-body text-center\">\n        <table class=\"table\">\n          <tr>\n            <th>{{ \"name\" | trans }} *</th>\n            <td>\n              <input type=\"text\" class=\"form-control input-sm\" [(ngModel)]=\"resource.name\" >\n            </td>\n          </tr>\n        </table>\n      </div>\n      <div class=\"modal-footer text-center\">\n          <button type=\"button\" class=\"btn btn-default\" (click)=\"closeModal()\" >{{ \"close\" | trans }}</button>\n          <button class=\"btn btn-primary\" [disabled]=\"isSubmitted\" (click)=\"send()\" >{{ \"add\" | trans }}</button>\n      </div>\n    </div><!-- /.modal-content -->\n  </div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "./src/app/user/components/role/role-form/role-form.component.scss":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/role/role-form/role-form.component.scss ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3VzZXIvY29tcG9uZW50cy9yb2xlL3JvbGUtZm9ybS9yb2xlLWZvcm0uY29tcG9uZW50LnNjc3MifQ== */"

/***/ }),

/***/ "./src/app/user/components/role/role-form/role-form.component.ts":
/*!***********************************************************************!*\
  !*** ./src/app/user/components/role/role-form/role-form.component.ts ***!
  \***********************************************************************/
/*! exports provided: RoleFormComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "RoleFormComponent", function() { return RoleFormComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _app_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../app.module */ "./src/app/app.module.ts");
/* harmony import */ var _services_role_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../services/role.service */ "./src/app/user/services/role.service.ts");
/* harmony import */ var _shared_message__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../shared/message */ "./src/app/shared/message.ts");
/* harmony import */ var _shared_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../../shared/helper */ "./src/app/shared/helper.ts");






let RoleFormComponent = class RoleFormComponent {
    constructor(roleService) {
        this.roleService = roleService;
        this.doc = _app_module__WEBPACK_IMPORTED_MODULE_2__["AppModule"].doc;
        this.isSubmitted = false;
        this.requiredFields = [
            'name'
        ];
        this.resource = {};
        this.isUpdate = false;
    }
    ngOnInit() {
    }
    validate() {
        let valid = true;
        this.requiredFields.forEach(element => {
            if (!this.resource[element])
                valid = false;
        });
        return valid;
    }
    send() {
        if (!this.isUpdate)
            this.store();
        else
            this.update();
    }
    store() {
        if (!this.validate())
            return _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(_shared_helper__WEBPACK_IMPORTED_MODULE_5__["Helper"].trans('fill all required data'));
        this.isSubmitted = true;
        this.roleService.store(this.toFormData()).subscribe((res) => {
            const data = res;
            if (data.status == 1) {
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].success(data.message);
                this.resource = {};
                this.updateResources();
            }
            else
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(data.message);
            this.isSubmitted = false;
        });
    }
    update() {
        if (!this.validate())
            return _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(_shared_helper__WEBPACK_IMPORTED_MODULE_5__["Helper"].trans('fill all required data'));
        this.isSubmitted = true;
        this.roleService.update(this.resource.id, this.toFormData()).subscribe((res) => {
            const data = res;
            if (data.status == 1) {
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].success(data.message);
                this.updateResources();
            }
            else
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(data.message);
            this.isSubmitted = false;
        });
    }
    /**
     * convert object to form data
     *
     */
    toFormData() {
        let data = new FormData();
        for (let key of Object.keys(this.resource)) {
            if (this.resource[key])
                data.append(key, this.resource[key]);
        }
        return data;
    }
    /**
     * close modal
     */
    closeModal() {
        const id = this.isUpdate ? '#updateModal' : '#createModal';
        this.doc.jquery(id).modal('hide');
    }
    /**
     * load personal image
     */
    viewImage(event) {
        _shared_helper__WEBPACK_IMPORTED_MODULE_5__["Helper"].loadImage(event, 'image', this.resource);
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], RoleFormComponent.prototype, "resource", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], RoleFormComponent.prototype, "isUpdate", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], RoleFormComponent.prototype, "updateResources", void 0);
RoleFormComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-role-form',
        template: __webpack_require__(/*! ./role-form.component.html */ "./src/app/user/components/role/role-form/role-form.component.html"),
        styles: [__webpack_require__(/*! ./role-form.component.scss */ "./src/app/user/components/role/role-form/role-form.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_role_service__WEBPACK_IMPORTED_MODULE_3__["RoleService"]])
], RoleFormComponent);



/***/ }),

/***/ "./src/app/user/components/role/role-index/role-index.component.html":
/*!***************************************************************************!*\
  !*** ./src/app/user/components/role/role-index/role-index.component.html ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<app-breadcrumb [breadcrumbList]=\"breadcrumbList\" *ngIf=\"!updateMode\"></app-breadcrumb>\n\n<app-breadcrumb [breadcrumbList]=\"breadcrumbList2\" *ngIf=\"updateMode\" ></app-breadcrumb>\n\n<div class=\"box box-primary material-shadow w3-white table-responsive\" *ngIf=\"!updateMode\" >\n  <div class=\"box-header\">\n    <button mat-raised-button color=\"primary\" (click)=\"doc.jquery('#createModal').modal('show');\" style=\"margin: 5px\"  >\n      <span class=\"fa fa-plus\" ></span> {{ \"add\" | trans }}\n    </button>\n  </div>\n\n  <br>\n\n</div>\n\n<div class=\"mat-elevation-z8 w3-white\" style=\"padding: 7px\" *ngIf=\"!updateMode\" >\n  <input  class=\"form-control\"\n  (keyup)=\"search($event.target.value)\" placeholder=\"{{ 'search' | trans }}\">\n  <br>\n  <table mat-table [dataSource]=\"dataSource\" matSort  class=\"\">\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"name\" sticky>\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"name\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\">\n          <span class=\"w3-margin-right\">\n              {{element.name}}\n          </span>\n        </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"action\">\n          <th mat-header-cell *matHeaderCellDef mat-sort-header> </th>\n          <td mat-cell *matCellDef=\"let element\">\n              <button mat-button color=\"info\"  (click)=\"edit(element)\" >\n                <i class=\"fa fa-edit\"></i>\n              </button>\n              <button mat-button color=\"info\"  (click)=\"permission(element)\" >\n                <i class=\"fa fa-th-list\"></i>\n              </button>\n              <button mat-button color=\"warn\" *ngIf=\"element.can_delete\" (click)=\"destroy(element.id)\" >\n                <i class=\"fa fa-trash\"></i>\n              </button>\n          </td>\n     </ng-container>\n\n      <tr mat-header-row *matHeaderRowDef=\"displayedColumns\"></tr>\n      <tr mat-row *matRowDef=\"let row; columns: displayedColumns;\"></tr>\n    </table>\n\n    <mat-paginator [pageSizeOptions]=\"[5, 10, 20]\" showFirstLastButtons></mat-paginator>\n</div>\n\n<div class=\"w3-white\" *ngIf=\"updateMode\" >\n  <button (click)=\"updateMode=false\" class=\"w3-white shadow w3-margin w3-large btn\"  >\n    <i class=\"fa fa-angle-right\" ></i> {{ \"back\" | trans }}\n </button>\n  <app-permission [role]=\"permissionItem\" [updateMode]=\"updateMode\" [loadResources]=\"updateResources\" ></app-permission>\n</div>\n\n\n  <app-role-form [updateResources]=\"updateResources\" [resource]=\"updateItem\" [isUpdate]=\"true\" ></app-role-form>\n  <app-role-form [updateResources]=\"updateResources\" [resource]=\"{}\" [isUpdate]=\"false\" ></app-role-form>\n\n"

/***/ }),

/***/ "./src/app/user/components/role/role-index/role-index.component.scss":
/*!***************************************************************************!*\
  !*** ./src/app/user/components/role/role-index/role-index.component.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "table {\n  width: 100%;\n}\n\nth.mat-sort-header-sorted {\n  color: black;\n}\n\nth {\n  font-size: 14px;\n  font-weight: bold;\n  color: black;\n}\n\n.mat-elevation-z8 {\n  overflow: auto;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIi9tZWRpYS9tb2hhbWVkLzZDMzJFOEZFMzJFOENERTAvcHJvamVjdHMvSElNLUZyb250L3NyYy9hcHAvdXNlci9jb21wb25lbnRzL3JvbGUvcm9sZS1pbmRleC9yb2xlLWluZGV4LmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC91c2VyL2NvbXBvbmVudHMvcm9sZS9yb2xlLWluZGV4L3JvbGUtaW5kZXguY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7RUFDRSxXQUFBO0FDQ0Y7O0FERUE7RUFDRSxZQUFBO0FDQ0Y7O0FER0E7RUFDRSxlQUFBO0VBQ0EsaUJBQUE7RUFDQSxZQUFBO0FDQUY7O0FER0E7RUFDRSxjQUFBO0FDQUYiLCJmaWxlIjoic3JjL2FwcC91c2VyL2NvbXBvbmVudHMvcm9sZS9yb2xlLWluZGV4L3JvbGUtaW5kZXguY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJ0YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xufVxuXG50aC5tYXQtc29ydC1oZWFkZXItc29ydGVkIHtcbiAgY29sb3I6IGJsYWNrO1xufVxuXG5cbnRoIHtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgY29sb3I6IGJsYWNrO1xufVxuXG4ubWF0LWVsZXZhdGlvbi16OCB7XG4gIG92ZXJmbG93OiBhdXRvO1xufVxuIiwidGFibGUge1xuICB3aWR0aDogMTAwJTtcbn1cblxudGgubWF0LXNvcnQtaGVhZGVyLXNvcnRlZCB7XG4gIGNvbG9yOiBibGFjaztcbn1cblxudGgge1xuICBmb250LXNpemU6IDE0cHg7XG4gIGZvbnQtd2VpZ2h0OiBib2xkO1xuICBjb2xvcjogYmxhY2s7XG59XG5cbi5tYXQtZWxldmF0aW9uLXo4IHtcbiAgb3ZlcmZsb3c6IGF1dG87XG59Il19 */"

/***/ }),

/***/ "./src/app/user/components/role/role-index/role-index.component.ts":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/role/role-index/role-index.component.ts ***!
  \*************************************************************************/
/*! exports provided: RoleIndexComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "RoleIndexComponent", function() { return RoleIndexComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _node_modules_angular_hashtable__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/angular-hashtable */ "./node_modules/angular-hashtable/fesm2015/angular-hashtable.js");
/* harmony import */ var _services_role_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../services/role.service */ "./src/app/user/services/role.service.ts");
/* harmony import */ var _app_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../app.module */ "./src/app/app.module.ts");
/* harmony import */ var _node_modules_angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../../../../node_modules/@angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _shared_helper__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../../../shared/helper */ "./src/app/shared/helper.ts");
/* harmony import */ var _angular_material__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/material */ "./node_modules/@angular/material/esm2015/material.js");
/* harmony import */ var src_app_shared_message__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! src/app/shared/message */ "./src/app/shared/message.ts");









let RoleIndexComponent = class RoleIndexComponent {
    constructor(roleService, router) {
        this.roleService = roleService;
        this.router = router;
        this.doc = _app_module__WEBPACK_IMPORTED_MODULE_4__["AppModule"].doc;
        // Resources list
        this.resources = null;
        this.updateMode = false;
        // init breadcrum
        this.breadcrumbList = [];
        this.breadcrumbList2 = [];
        // remove options
        this.showRemoveButton = false;
        this.showRemoveModal = false;
        this.trashList = new _node_modules_angular_hashtable__WEBPACK_IMPORTED_MODULE_2__["HashTable"]();
        this.removed = [];
        // update
        this.updateItem = {};
        this.permissionItem = {};
        this.dataSource = new _angular_material__WEBPACK_IMPORTED_MODULE_7__["MatTableDataSource"](this.resources);
        // init breadcrum
        this.initBreadcrumb();
        this.initDisplayColumns();
        this.initMatDatatable();
        this.updateResources = () => {
            this.loadResources();
        };
    }
    initMatDatatable() {
        this.dataSource.sort = this.sort;
        this.dataSource.paginator = this.paginator;
    }
    initBreadcrumb() {
        this.breadcrumbList = [
            { name: 'home', url: '/' },
            { name: 'roles' }
        ];
    }
    initDisplayColumns() {
        this.displayedColumns = [
            'name', 'action'
        ];
    }
    refreshDataSource(data) {
        this.resources = data;
        this.dataSource.data = data;
    }
    destroy(id) {
        this.doc.swal.confirm(_shared_helper__WEBPACK_IMPORTED_MODULE_6__["Helper"].trans('are you sure'), () => {
            this.roleService.destroy(id).subscribe((res) => {
                if (res.status == 1) {
                    src_app_shared_message__WEBPACK_IMPORTED_MODULE_8__["Message"].success(res.message);
                    this.loadResources();
                }
                else
                    src_app_shared_message__WEBPACK_IMPORTED_MODULE_8__["Message"].error(res.message);
            });
        });
    }
    loadResources() {
        this.roleService.get().subscribe((res) => {
            this.resources = res;
            this.dataSource.data = res;
            //
            this.refreshDataSource(res);
        });
    }
    edit(item) {
        this.updateItem = item;
        this.doc.jquery('#updateModal').modal('show');
    }
    ngOnInit() {
        this.loadResources();
        this.searchKey = "";
    }
    showUpdateModal(item) {
        this.updateItem = item;
    }
    search(filterValue) {
        if (this.dataSource)
            this.dataSource.filter = filterValue.trim().toLowerCase();
    }
    permission(item) {
        this.breadcrumbList2 = [
            { name: 'home', url: '/' },
            { name: 'roles', url: '/users/role' },
            { name: item.name }
        ];
        this.updateMode = true;
        this.permissionItem = item;
        this.doc.jquery('#permissionModal').modal('show');
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material__WEBPACK_IMPORTED_MODULE_7__["MatPaginator"]),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_material__WEBPACK_IMPORTED_MODULE_7__["MatPaginator"])
], RoleIndexComponent.prototype, "paginator", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material__WEBPACK_IMPORTED_MODULE_7__["MatSort"]),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_material__WEBPACK_IMPORTED_MODULE_7__["MatSort"])
], RoleIndexComponent.prototype, "sort", void 0);
RoleIndexComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-role-index',
        template: __webpack_require__(/*! ./role-index.component.html */ "./src/app/user/components/role/role-index/role-index.component.html"),
        styles: [__webpack_require__(/*! ./role-index.component.scss */ "./src/app/user/components/role/role-index/role-index.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_role_service__WEBPACK_IMPORTED_MODULE_3__["RoleService"], _node_modules_angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])
], RoleIndexComponent);



/***/ }),

/***/ "./src/app/user/components/user-history/user-history.component.html":
/*!**************************************************************************!*\
  !*** ./src/app/user/components/user-history/user-history.component.html ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"w3-block w3-row\">\n  <div class=\"w3-white material-shadow safe-box col-lg-6 col-md-6 col-sm-6\">\n    <div class=\"safe-box-header w3-large\" style=\"padding: 5px!important\">\n      {{ \"users history\" | trans }}\n    </div>\n    <div class=\"border-bottom-dashed\"></div>\n    <br>\n\n    <div class=\"row\">\n\n      <div class=\"col-lg-12\">\n        <div class=\"custom-panel w3-display-container w3-round application-panel student-info-panel\">\n\n          <div class=\"custom-panel-body table-responsive w3-padding w3-center\" style=\"height: 400px;\" >\n            <table class=\"table-bordered\" >\n              <thead>\n                <th>#</th>\n                <th>{{ \"name\" | trans }}</th>\n                <th>{{ \"start_date\" | trans }}</th>\n                <th>{{ \"end_date\" | trans }}</th>\n                <th></th>\n              </thead>\n              <tbody>\n\n                <tr>\n                  <td></td>\n                  <td>\n                    <button class=\"fa fa-plus w3-block btn btn-default btn-flat\" ></button>\n                  </td>\n                </tr>\n              </tbody>\n            </table>\n          </div>\n        </div>\n      </div>\n\n\n\n    </div>\n\n\n  </div>\n</div>\n"

/***/ }),

/***/ "./src/app/user/components/user-history/user-history.component.scss":
/*!**************************************************************************!*\
  !*** ./src/app/user/components/user-history/user-history.component.scss ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3VzZXIvY29tcG9uZW50cy91c2VyLWhpc3RvcnkvdXNlci1oaXN0b3J5LmNvbXBvbmVudC5zY3NzIn0= */"

/***/ }),

/***/ "./src/app/user/components/user-history/user-history.component.ts":
/*!************************************************************************!*\
  !*** ./src/app/user/components/user-history/user-history.component.ts ***!
  \************************************************************************/
/*! exports provided: UserHistoryComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UserHistoryComponent", function() { return UserHistoryComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let UserHistoryComponent = class UserHistoryComponent {
    constructor() { }
    ngOnInit() {
    }
};
UserHistoryComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-user-history',
        template: __webpack_require__(/*! ./user-history.component.html */ "./src/app/user/components/user-history/user-history.component.html"),
        styles: [__webpack_require__(/*! ./user-history.component.scss */ "./src/app/user/components/user-history/user-history.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], UserHistoryComponent);



/***/ }),

/***/ "./src/app/user/components/user/user-form/user-form.component.html":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/user/user-form/user-form.component.html ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n<!-- form modal -->\n<div class=\"modal fade\" id=\"{{ isUpdate? 'update' : 'create' }}Modal\" role=\"dialog\">\n  <div class=\"modal-dialog\" role=\"document\">\n    <div class=\"modal-content\">\n      <div class=\"modal-header\">\n        <h4 class=\"modal-title\">\n          <span *ngIf=\"isUpdate\" >{{ \"edit user\" | trans }}</span>\n          <span *ngIf=\"!isUpdate\" >{{ \"add user\" | trans }}</span>\n\n        </h4>\n      </div>\n      <div class=\"modal-body text-center\">\n        <img src=\"{{ resource.image_url }}\" alt=\"\" style=\"width: 50px;\" class=\"w3-round\" >\n        <br>\n        <table class=\"table\">\n          <tr>\n            <th>{{ \"image\" | trans }} </th>\n            <td>\n              <input type=\"file\"\n              (change)=\"viewImage($event)\"\n              class=\"form-control input-sm\"  [(ngModel)]=\"resource.image\" >\n            </td>\n          </tr>\n          <tr>\n            <th>{{ \"name\" | trans }} *</th>\n            <td>\n              <input type=\"text\" class=\"form-control input-sm\"  [(ngModel)]=\"resource.name\" >\n            </td>\n          </tr>\n          <tr>\n            <th>{{ \"email\" | trans }} *</th>\n            <td>\n              <input type=\"text\" class=\"form-control input-sm\"  [(ngModel)]=\"resource.email\" >\n            </td>\n          </tr>\n          <tr>\n            <th>{{ \"password\" | trans }} *</th>\n            <td>\n              <input type=\"password\" class=\"form-control input-sm\"  [(ngModel)]=\"resource.password\" >\n            </td>\n          </tr>\n          <tr>\n            <th>{{ \"username\" | trans }} *</th>\n            <td>\n              <input type=\"text\" class=\"form-control input-sm\"  [(ngModel)]=\"resource.username\" >\n            </td>\n          </tr>\n          <tr>\n            <th>{{ \"phone\" | trans }} </th>\n            <td>\n              <input type=\"text\" class=\"form-control input-sm\"  [(ngModel)]=\"resource.phone\" >\n            </td>\n          </tr>\n          <tr>\n            <th>{{ \"role\" | trans }} </th>\n            <td>\n              <select class=\"form-control input-sm\"  [(ngModel)]=\"resource.role_id\"  >\n                <option *ngFor=\"let item of roles\" value=\"{{ item.id }}\">{{ item.name }}</option>\n              </select>\n            </td>\n          </tr>\n        </table>\n      </div>\n      <div class=\"modal-footer text-center\">\n          <button type=\"button\" class=\"btn btn-default\" (click)=\"closeModal()\" >{{ \"close\" | trans }}</button>\n          <button class=\"btn btn-primary\" [disabled]=\"isSubmitted\" (click)=\"send()\" >{{ \"add\" | trans }}</button>\n      </div>\n    </div><!-- /.modal-content -->\n  </div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "./src/app/user/components/user/user-form/user-form.component.scss":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/user/user-form/user-form.component.scss ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3VzZXIvY29tcG9uZW50cy91c2VyL3VzZXItZm9ybS91c2VyLWZvcm0uY29tcG9uZW50LnNjc3MifQ== */"

/***/ }),

/***/ "./src/app/user/components/user/user-form/user-form.component.ts":
/*!***********************************************************************!*\
  !*** ./src/app/user/components/user/user-form/user-form.component.ts ***!
  \***********************************************************************/
/*! exports provided: UserFormComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UserFormComponent", function() { return UserFormComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _app_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../app.module */ "./src/app/app.module.ts");
/* harmony import */ var _services_user_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../services/user.service */ "./src/app/user/services/user.service.ts");
/* harmony import */ var _shared_message__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../shared/message */ "./src/app/shared/message.ts");
/* harmony import */ var _shared_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../../shared/helper */ "./src/app/shared/helper.ts");
/* harmony import */ var src_app_user_services_role_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! src/app/user/services/role.service */ "./src/app/user/services/role.service.ts");







let UserFormComponent = class UserFormComponent {
    constructor(userService, roleService) {
        this.userService = userService;
        this.roleService = roleService;
        this.doc = _app_module__WEBPACK_IMPORTED_MODULE_2__["AppModule"].doc;
        this.isSubmitted = false;
        this.requiredFields = [
            'name', 'email', 'password', 'username'
        ];
        this.resource = {};
        this.isUpdate = false;
        this.roles = null;
    }
    ngOnInit() {
        this.loadRoles();
    }
    loadRoles() {
        this.roleService.get().subscribe((res) => {
            this.roles = res;
        });
    }
    validate() {
        let valid = true;
        this.requiredFields.forEach(element => {
            if (!this.resource[element])
                valid = false;
        });
        return valid;
    }
    send() {
        if (!this.isUpdate)
            this.store();
        else
            this.update();
    }
    store() {
        if (!this.validate())
            return _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(_shared_helper__WEBPACK_IMPORTED_MODULE_5__["Helper"].trans('fill all required data'));
        this.isSubmitted = true;
        this.userService.store(this.toFormData()).subscribe((res) => {
            const data = res;
            if (data.status == 1) {
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].success(data.message);
                this.resource = {};
                this.updateResources();
            }
            else
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(data.message);
            this.isSubmitted = false;
        });
    }
    update() {
        if (!this.validate())
            return _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(_shared_helper__WEBPACK_IMPORTED_MODULE_5__["Helper"].trans('fill all required data'));
        this.isSubmitted = true;
        this.userService.update(this.resource.id, this.toFormData()).subscribe((res) => {
            const data = res;
            if (data.status == 1) {
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].success(data.message);
                this.updateResources();
            }
            else
                _shared_message__WEBPACK_IMPORTED_MODULE_4__["Message"].error(data.message);
            this.isSubmitted = false;
        });
    }
    /**
     * convert object to form data
     *
     */
    toFormData() {
        let data = new FormData();
        for (let key of Object.keys(this.resource)) {
            if (this.resource[key])
                data.append(key, this.resource[key]);
        }
        return data;
    }
    /**
     * close modal
     */
    closeModal() {
        const id = this.isUpdate ? '#updateModal' : '#createModal';
        this.doc.jquery(id).modal('hide');
    }
    /**
     * load personal image
     */
    viewImage(event) {
        _shared_helper__WEBPACK_IMPORTED_MODULE_5__["Helper"].loadImage(event, 'image', this.resource);
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], UserFormComponent.prototype, "resource", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], UserFormComponent.prototype, "isUpdate", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], UserFormComponent.prototype, "updateResources", void 0);
UserFormComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-user-form',
        template: __webpack_require__(/*! ./user-form.component.html */ "./src/app/user/components/user/user-form/user-form.component.html"),
        styles: [__webpack_require__(/*! ./user-form.component.scss */ "./src/app/user/components/user/user-form/user-form.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_user_service__WEBPACK_IMPORTED_MODULE_3__["UserService"], src_app_user_services_role_service__WEBPACK_IMPORTED_MODULE_6__["RoleService"]])
], UserFormComponent);



/***/ }),

/***/ "./src/app/user/components/user/user-index/user-index.component.html":
/*!***************************************************************************!*\
  !*** ./src/app/user/components/user/user-index/user-index.component.html ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<app-breadcrumb [breadcrumbList]=\"breadcrumbList\"></app-breadcrumb>\n\n<div class=\"box box-primary material-shadow w3-white table-responsive\" >\n  <div class=\"box-header\">\n    <button class=\"btn btn-primary\" (click)=\"doc.jquery('#createModal').modal('show');\" style=\"margin: 5px\"  >\n      <span class=\"fa fa-plus\" ></span> {{ \"add\" | trans }}\n    </button>\n  </div>\n  <br>\n</div>\n\n<div class=\"mat-elevation-z8 w3-white\" style=\"padding: 7px\" >\n  <input  class=\"form-control\"\n  (keyup)=\"search($event.target.value)\" placeholder=\"{{ 'search' | trans }}\">\n  <br>\n  <table mat-table [dataSource]=\"dataSource\" matSort  class=\"\">\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"image\">\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"image\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\">\n          <img src=\"{{ element.image_url }}\" alt=\"\" height=\"20px\" class=\"w3-round\" >\n        </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"name\" sticky>\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"name\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\">\n          <span class=\"w3-margin-right\">\n              {{element.name}}\n          </span>\n        </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"email\">\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"email\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\"> {{element.email  }} </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"password\">\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"password\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\">\n          <button mat-button color=\"info\"  style=\"margin-left: 5px;margin-right: 5px\" (click)=\"doc.jquery('.row-'+element.id).toggle(600)\"  >\n            <i class=\"fa fa-eye\"></i>\n          </button>\n          <span style=\"display: none\" class=\"row-{{ element.id }}\" >{{element.password  }}</span>\n        </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"username\">\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"username\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\"> {{element.username  }} </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"phone\">\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"phone\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\"> {{element.phone  }} </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"role\">\n        <th mat-header-cell *matHeaderCellDef mat-sort-header>{{ \"role\" | trans }}</th>\n        <td mat-cell *matCellDef=\"let element\"> {{ element.role? element.role.name : ''  }} </td>\n      </ng-container>\n\n      <!-- Position Column -->\n      <ng-container matColumnDef=\"action\">\n          <th mat-header-cell *matHeaderCellDef mat-sort-header> </th>\n          <td mat-cell *matCellDef=\"let element\">\n              <button mat-button color=\"info\"  (click)=\"edit(element)\" >\n                <i class=\"fa fa-edit\"></i>\n              </button>\n              <button mat-button color=\"warn\"  (click)=\"destroy(element.id)\" >\n                <i class=\"fa fa-trash\"></i>\n              </button>\n          </td>\n     </ng-container>\n\n      <tr mat-header-row *matHeaderRowDef=\"displayedColumns\"></tr>\n      <tr mat-row *matRowDef=\"let row; columns: displayedColumns;\"></tr>\n    </table>\n\n    <mat-paginator [pageSizeOptions]=\"[5, 10, 20]\" showFirstLastButtons></mat-paginator>\n</div>\n\n\n\n  <app-user-form [updateResources]=\"updateResources\" [resource]=\"updateItem\" [isUpdate]=\"true\" ></app-user-form>\n  <app-user-form [updateResources]=\"updateResources\" [resource]=\"{}\" [isUpdate]=\"false\" ></app-user-form>\n"

/***/ }),

/***/ "./src/app/user/components/user/user-index/user-index.component.scss":
/*!***************************************************************************!*\
  !*** ./src/app/user/components/user/user-index/user-index.component.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "table {\n  width: 100%;\n}\n\nth.mat-sort-header-sorted {\n  color: black;\n}\n\nth {\n  font-size: 14px;\n  font-weight: bold;\n  color: black;\n}\n\n.mat-elevation-z8 {\n  overflow: auto;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIi9tZWRpYS9tb2hhbWVkLzZDMzJFOEZFMzJFOENERTAvcHJvamVjdHMvSElNLUZyb250L3NyYy9hcHAvdXNlci9jb21wb25lbnRzL3VzZXIvdXNlci1pbmRleC91c2VyLWluZGV4LmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC91c2VyL2NvbXBvbmVudHMvdXNlci91c2VyLWluZGV4L3VzZXItaW5kZXguY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7RUFDRSxXQUFBO0FDQ0Y7O0FERUE7RUFDRSxZQUFBO0FDQ0Y7O0FER0E7RUFDRSxlQUFBO0VBQ0EsaUJBQUE7RUFDQSxZQUFBO0FDQUY7O0FER0E7RUFDRSxjQUFBO0FDQUYiLCJmaWxlIjoic3JjL2FwcC91c2VyL2NvbXBvbmVudHMvdXNlci91c2VyLWluZGV4L3VzZXItaW5kZXguY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJ0YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xufVxuXG50aC5tYXQtc29ydC1oZWFkZXItc29ydGVkIHtcbiAgY29sb3I6IGJsYWNrO1xufVxuXG5cbnRoIHtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgY29sb3I6IGJsYWNrO1xufVxuXG4ubWF0LWVsZXZhdGlvbi16OCB7XG4gIG92ZXJmbG93OiBhdXRvO1xufVxuIiwidGFibGUge1xuICB3aWR0aDogMTAwJTtcbn1cblxudGgubWF0LXNvcnQtaGVhZGVyLXNvcnRlZCB7XG4gIGNvbG9yOiBibGFjaztcbn1cblxudGgge1xuICBmb250LXNpemU6IDE0cHg7XG4gIGZvbnQtd2VpZ2h0OiBib2xkO1xuICBjb2xvcjogYmxhY2s7XG59XG5cbi5tYXQtZWxldmF0aW9uLXo4IHtcbiAgb3ZlcmZsb3c6IGF1dG87XG59Il19 */"

/***/ }),

/***/ "./src/app/user/components/user/user-index/user-index.component.ts":
/*!*************************************************************************!*\
  !*** ./src/app/user/components/user/user-index/user-index.component.ts ***!
  \*************************************************************************/
/*! exports provided: UserIndexComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UserIndexComponent", function() { return UserIndexComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _node_modules_angular_hashtable__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/angular-hashtable */ "./node_modules/angular-hashtable/fesm2015/angular-hashtable.js");
/* harmony import */ var _services_user_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../services/user.service */ "./src/app/user/services/user.service.ts");
/* harmony import */ var _app_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../app.module */ "./src/app/app.module.ts");
/* harmony import */ var _node_modules_angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../../../../node_modules/@angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _shared_helper__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../../../shared/helper */ "./src/app/shared/helper.ts");
/* harmony import */ var _angular_material__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/material */ "./node_modules/@angular/material/esm2015/material.js");
/* harmony import */ var src_app_shared_message__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! src/app/shared/message */ "./src/app/shared/message.ts");









let UserIndexComponent = class UserIndexComponent {
    constructor(userService, router) {
        this.userService = userService;
        this.router = router;
        this.doc = _app_module__WEBPACK_IMPORTED_MODULE_4__["AppModule"].doc;
        // Resources list
        this.resources = null;
        // init breadcrum
        this.breadcrumbList = [];
        // remove options
        this.showRemoveButton = false;
        this.showRemoveModal = false;
        this.trashList = new _node_modules_angular_hashtable__WEBPACK_IMPORTED_MODULE_2__["HashTable"]();
        this.removed = [];
        // update
        this.updateItem = {};
        this.dataSource = new _angular_material__WEBPACK_IMPORTED_MODULE_7__["MatTableDataSource"](this.resources);
        // init breadcrum
        this.initBreadcrumb();
        this.initDisplayColumns();
        this.initMatDatatable();
        this.updateResources = () => {
            this.loadResources();
        };
    }
    initMatDatatable() {
        this.dataSource.sort = this.sort;
        this.dataSource.paginator = this.paginator;
    }
    initBreadcrumb() {
        this.breadcrumbList = [
            { name: 'home', url: '/' },
            { name: 'users' }
        ];
    }
    initDisplayColumns() {
        this.displayedColumns = [
            'image', 'name', 'email', 'password', 'username', 'phone', 'role', "action"
        ];
    }
    refreshDataSource(data) {
        this.resources = data;
        this.dataSource.data = data;
    }
    destroy(id) {
        this.doc.swal.confirm(_shared_helper__WEBPACK_IMPORTED_MODULE_6__["Helper"].trans('are you sure'), () => {
            this.userService.destroy(id).subscribe((res) => {
                if (res.status == 1) {
                    src_app_shared_message__WEBPACK_IMPORTED_MODULE_8__["Message"].success(res.message);
                    this.loadResources();
                }
                else
                    src_app_shared_message__WEBPACK_IMPORTED_MODULE_8__["Message"].error(res.message);
            });
        });
    }
    loadResources() {
        this.userService.get().subscribe((res) => {
            this.resources = res;
            this.dataSource.data = res;
            //
            this.refreshDataSource(res);
        });
    }
    edit(item) {
        this.updateItem = item;
        this.doc.jquery('#updateModal').modal('show');
    }
    ngOnInit() {
        this.loadResources();
        this.searchKey = "";
    }
    showUpdateModal(item) {
        this.updateItem = item;
    }
    search(filterValue) {
        if (this.dataSource)
            this.dataSource.filter = filterValue.trim().toLowerCase();
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material__WEBPACK_IMPORTED_MODULE_7__["MatPaginator"]),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_material__WEBPACK_IMPORTED_MODULE_7__["MatPaginator"])
], UserIndexComponent.prototype, "paginator", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material__WEBPACK_IMPORTED_MODULE_7__["MatSort"]),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_material__WEBPACK_IMPORTED_MODULE_7__["MatSort"])
], UserIndexComponent.prototype, "sort", void 0);
UserIndexComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-user-index',
        template: __webpack_require__(/*! ./user-index.component.html */ "./src/app/user/components/user/user-index/user-index.component.html"),
        styles: [__webpack_require__(/*! ./user-index.component.scss */ "./src/app/user/components/user/user-index/user-index.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_user_service__WEBPACK_IMPORTED_MODULE_3__["UserService"], _node_modules_angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])
], UserIndexComponent);



/***/ }),

/***/ "./src/app/user/user-routing.module.ts":
/*!*********************************************!*\
  !*** ./src/app/user/user-routing.module.ts ***!
  \*********************************************/
/*! exports provided: UserRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UserRoutingModule", function() { return UserRoutingModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _shared_auth__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../shared/auth */ "./src/app/shared/auth.ts");
/* harmony import */ var _shared_middlewares_auth_guest_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../shared/middlewares/auth-guest.service */ "./src/app/shared/middlewares/auth-guest.service.ts");
/* harmony import */ var _components_role_role_index_role_index_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/role/role-index/role-index.component */ "./src/app/user/components/role/role-index/role-index.component.ts");
/* harmony import */ var _components_user_user_index_user_index_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/user/user-index/user-index.component */ "./src/app/user/components/user/user-index/user-index.component.ts");
/* harmony import */ var _user_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./user.component */ "./src/app/user/user.component.ts");








const routes = [
    {
        path: "",
        component: _user_component__WEBPACK_IMPORTED_MODULE_7__["UserComponent"],
        children: [
            {
                path: 'u',
                canActivate: [_shared_middlewares_auth_guest_service__WEBPACK_IMPORTED_MODULE_4__["AuthGuestService"]],
                data: { can: _shared_auth__WEBPACK_IMPORTED_MODULE_3__["Auth"].can('user_read') },
                component: _components_user_user_index_user_index_component__WEBPACK_IMPORTED_MODULE_6__["UserIndexComponent"]
            },
            {
                path: 'role',
                canActivate: [_shared_middlewares_auth_guest_service__WEBPACK_IMPORTED_MODULE_4__["AuthGuestService"]],
                data: { can: _shared_auth__WEBPACK_IMPORTED_MODULE_3__["Auth"].can('role_read') },
                component: _components_role_role_index_role_index_component__WEBPACK_IMPORTED_MODULE_5__["RoleIndexComponent"]
            }
        ]
    },
    {
        path: '**',
        redirectTo: '/',
        pathMatch: 'full'
    }
];
let UserRoutingModule = class UserRoutingModule {
};
UserRoutingModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [
            _angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)
        ],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })
], UserRoutingModule);



/***/ }),

/***/ "./src/app/user/user.component.html":
/*!******************************************!*\
  !*** ./src/app/user/user.component.html ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"row\">\n\n  <div class=\"col-md-3\">\n\n    <!-- navbar list -->\n    <div class=\"box box-primary material-shadow\">\n      <div class=\"box-body box-profile\">\n        <img class=\"profile-user-img img-responsive img-circle\" style=\"width: 60%!important\" src=\"/assets/img/application.gif\" alt=\"User profile picture\">\n\n        <h3 class=\"profile-username text-center\">{{ \"users\" | trans }}</h3>\n\n\n        <ul class=\"list-group list-group-unbordered\">\n          <li class=\"list-group-item\" permission=\"user_read\" >\n            <a href=\"#\" routerLink='/users/u' >\n                <b>{{ \"users\" | trans }}</b>\n                <a href=\"#\"  class=\"pull-left\">\n                  <i class=\"fa fa-users\" ></i>\n                </a>\n            </a>\n          </li>\n          <li class=\"list-group-item\" permission=\"role_read\" >\n            <a href=\"#\" routerLink='/users/role' >\n                <b>{{ \"roles\" | trans }}</b>\n                <a href=\"#\"  class=\"pull-left\">\n                  <i class=\"fa fa-th-list\" ></i>\n                </a>\n            </a>\n          </li>\n        </ul>\n      </div>\n      <!-- /.box-body -->\n    </div>\n    <!-- /.box -->\n\n  </div>\n  <!-- /.col -->\n  <div class=\"col-md-9\">\n      <router-outlet></router-outlet>\n  </div>\n  <!-- /.col -->\n</div>\n"

/***/ }),

/***/ "./src/app/user/user.component.scss":
/*!******************************************!*\
  !*** ./src/app/user/user.component.scss ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3VzZXIvdXNlci5jb21wb25lbnQuc2NzcyJ9 */"

/***/ }),

/***/ "./src/app/user/user.component.ts":
/*!****************************************!*\
  !*** ./src/app/user/user.component.ts ***!
  \****************************************/
/*! exports provided: UserComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UserComponent", function() { return UserComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let UserComponent = class UserComponent {
    constructor() { }
    ngOnInit() {
    }
};
UserComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-user',
        template: __webpack_require__(/*! ./user.component.html */ "./src/app/user/user.component.html"),
        styles: [__webpack_require__(/*! ./user.component.scss */ "./src/app/user/user.component.scss")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], UserComponent);



/***/ }),

/***/ "./src/app/user/user.module.ts":
/*!*************************************!*\
  !*** ./src/app/user/user.module.ts ***!
  \*************************************/
/*! exports provided: UserModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UserModule", function() { return UserModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _shared_shared_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../shared/shared.module */ "./src/app/shared/shared.module.ts");
/* harmony import */ var angular_datatables__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! angular-datatables */ "./node_modules/angular-datatables/index.js");
/* harmony import */ var _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../node_modules/@angular/material */ "./node_modules/@angular/material/esm2015/material.js");
/* harmony import */ var _user_routing_module__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./user-routing.module */ "./src/app/user/user-routing.module.ts");
/* harmony import */ var _user_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./user.component */ "./src/app/user/user.component.ts");
/* harmony import */ var _components_user_user_index_user_index_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/user/user-index/user-index.component */ "./src/app/user/components/user/user-index/user-index.component.ts");
/* harmony import */ var _components_user_user_form_user_form_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/user/user-form/user-form.component */ "./src/app/user/components/user/user-form/user-form.component.ts");
/* harmony import */ var _components_role_role_index_role_index_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./components/role/role-index/role-index.component */ "./src/app/user/components/role/role-index/role-index.component.ts");
/* harmony import */ var _components_role_role_form_role_form_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./components/role/role-form/role-form.component */ "./src/app/user/components/role/role-form/role-form.component.ts");
/* harmony import */ var _components_role_permission_permission_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./components/role/permission/permission.component */ "./src/app/user/components/role/permission/permission.component.ts");
/* harmony import */ var _components_user_history_user_history_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./components/user-history/user-history.component */ "./src/app/user/components/user-history/user-history.component.ts");













let UserModule = class UserModule {
    constructor() {
    }
};
UserModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        declarations: [
            _user_component__WEBPACK_IMPORTED_MODULE_6__["UserComponent"],
            _components_user_user_index_user_index_component__WEBPACK_IMPORTED_MODULE_7__["UserIndexComponent"],
            _components_user_user_form_user_form_component__WEBPACK_IMPORTED_MODULE_8__["UserFormComponent"],
            _components_role_role_index_role_index_component__WEBPACK_IMPORTED_MODULE_9__["RoleIndexComponent"],
            _components_role_role_form_role_form_component__WEBPACK_IMPORTED_MODULE_10__["RoleFormComponent"],
            _components_role_permission_permission_component__WEBPACK_IMPORTED_MODULE_11__["PermissionComponent"],
            _components_user_history_user_history_component__WEBPACK_IMPORTED_MODULE_12__["UserHistoryComponent"]
        ],
        imports: [
            _shared_shared_module__WEBPACK_IMPORTED_MODULE_2__["SharedModule"],
            _user_routing_module__WEBPACK_IMPORTED_MODULE_5__["UserRoutingModule"],
            angular_datatables__WEBPACK_IMPORTED_MODULE_3__["DataTablesModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatTableModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatPaginatorModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatSortModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatCheckboxModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatButtonModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatFormFieldModule"],
            _node_modules_angular_material__WEBPACK_IMPORTED_MODULE_4__["MatSlideToggleModule"]
        ]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], UserModule);



/***/ })

}]);
//# sourceMappingURL=user-user-module.js.map