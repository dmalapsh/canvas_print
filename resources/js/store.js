export default {
	state: {
		user_id: null,
		user_fio: "",
		breadcrumbs: {},
		permissions: [],
		cache: 0,
		role: null,
		search_query: null,
		search_type: null,
		loggedIn: false,
		isEditorMode: false,
		isSpinner: false,
        ProjectModalStatus: false,
        UserModalStatus: false
	},
	getters: {
		isSpinner: state => {
			return state.isSpinner;
		},
		isEditorMode: state => {
			return state.isEditorMode;
		},
		loggedIn: state => {
			return state.loggedIn;
		},
		getRole: state => {
			return state.role;
		},
		getUser: state => {
			return state.user_id;
		},
		getUserFIO: state => {
			return state.user_fio;
		},
		getCache: state => {
			return state.cache;
		},
        ProjectModalStatus: state => {
			return state.ProjectModalStatus;
		},
        UserModalStatus: state => {
			return state.UserModalStatus;
		}
	},
	mutations: {
		setLoggedIn(state, status) {
			state.loggedIn = status;
		},
		setUserId(state, user_id) {
			state.user_id = user_id;
		},
		setUserFIO(state, user_fio) {
			state.user_fio = user_fio;
		},
		setRole(state, role) {
			state.role = role;
		},
        SetProjectModalStatus(state, status){
            state.ProjectModalStatus = status;
        },
        SetUserModalStatus(state, status){
            state.UserModalStatus = status;
        }
	},
	actions: {
		logout() {
			localStorage.setItem("token", "");
			this.$router.push({ name: 'login' })
		},
	}
}
