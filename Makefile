.PHONY: serve-akreditasi
serve-akreditasi:
	@php yii serve --docroot="akreditasi/web" --port=22080

.PHONY: serve-admin
serve-admin:
	@php yii serve --docroot="admin/web" --port=21080
