export const apiDomain = Laravel.apiDomain;
export const siteName = Laravel.siteName;

export const login = apiDomain + '/sessions/create';
export const register = apiDomain + '/register';
export const currentUser = apiDomain + '/user';

export const loadRoles = apiDomain + '/roles';
export const loadPermissions = apiDomain + '/permissions';
export const attachPermission = apiDomain + '/attach-permission';

export const loadUsers = apiDomain + '/users';
