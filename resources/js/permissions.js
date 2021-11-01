export default {
	methods: {
		$visit(readMode) {
			if (this.$store) {
				if (this.$store.getters) {
					if (this.$store.getters.getRole) {
						if (readMode) {
							if (this.$store.getters.getRole < readMode) {
								this.$router.push({ name: "widgets" })
							}
						}
					}
				}
			}
		},
	},
}