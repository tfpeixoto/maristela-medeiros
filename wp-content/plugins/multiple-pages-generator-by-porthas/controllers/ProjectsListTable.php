<?php
/**
 * Projects list.
 *
 * @package MPG
 */

// Include WP_List_Table class file.
require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

// If check class exists or not.
if ( ! class_exists( 'Projects_List_Table' ) ) {

	/**
	 * Declare Class `Projects_List_Table`
	 */
	class Projects_List_Table extends WP_List_Table {

		/**
		 * Pagination per page.
		 *
		 * @var $per_page.
		 */
		public $per_page;

		/**
		 * Public constructor.
		 */
		public function __construct() {

			// Set parent defaults.
			parent::__construct();

			$this->per_page = $this->get_items_per_page( 'mpg_projects_per_page', 20 );
		}

		/**
		 * Entry Data
		 *
		 * @param string $search_by_name Project search by name.
		 * @return Records
		 */
		public function get_projects( $search_by_name ) {
			$projects_list_manage = new ProjectsListManage();
			$per_page             = $this->per_page;
			$data                 = $projects_list_manage->projects_list( $search_by_name, $per_page );
			return $data;
		}

		/**
		 * Prepare items
		 */
		public function prepare_items() {
			$search_by_name = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : ''; // phpcs:ignore
			$this->items    = $this->get_projects( $search_by_name );

			$per_page      = $this->per_page;
			$total_entries = new ProjectsListManage();
			$total_item    = $total_entries->total_projects();
			$this->set_pagination_args(
				array(
					'total_items' => $total_item,
					'per_page'    => $per_page,
					'total_pages' => ceil( $total_item / $per_page ),
				)
			);

			$sortable              = $this->get_sortable_columns();
			$columns               = $this->get_columns();
			$this->_column_headers = array( $columns, array(), $sortable );
			$this->views();
		}

		/**
		 * Columns
		 *
		 * @return string Column.
		 */
		public function get_columns() {
			$columns = array(
				'cb'          => '<input type="checkbox" />',
				'name'        => __( 'Project Name', 'mpg' ),
				'source_type' => __( 'Source Type', 'mpg' ),
				'created_at'  => __( 'Date', 'mpg' ),
			);
			return $columns;
		}

		/**
		 * Default Column
		 *
		 * @param mix $item Item.
		 * @param int $column_name Column name.
		 * @return mix
		 */
		public function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'name':
					return $item->$column_name;
				case 'created_at':
					return date_i18n( 'd M, Y, H:i a', $item->$column_name );
				case 'source_type':
					$source_type = str_replace( '_', ' ', $item->$column_name );
					return esc_html( ucwords( $source_type ) );
				default:
					return __( 'No Data Found', 'mpg' );
			}
		}

		/**
		 * View Record button.
		 *
		 * @param string $item email.
		 * @return sttring Field and action
		 */
		public function column_name( $item ) {
			$action = array(
				'edit'   => sprintf(
					'<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page'   => 'mpg-project-builder',
								'action' => 'edit_project',
								'id'     => $item->id,
							),
							admin_url( 'admin.php' )
						)
					),
					esc_html__( 'Edit', 'mpg' )
				),
				'delete' => sprintf(
					'<a href="%s" onclick="return confirm(\'%s\');">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page'   => 'mpg-project-builder',
								'action' => 'delete_project',
								'id'     => $item->id,
							),
							admin_url( 'admin.php' )
						)
					),
					esc_html__( 'Are you sure you want to delete this project?', 'mpg' ),
					esc_html__( 'Delete', 'mpg' )
				),
			);
			return sprintf( '%1$s %2$s', $item->name, $this->row_actions( $action ) );
		}

		/**
		 * Bulk delete actions.
		 */
		public function get_bulk_actions() {
			$delete_action = array(
				'bulk-delete' => __( 'Delete', 'mpg' ),
			);
			return $delete_action;
		}

		/**
		 * Checkbox in row.
		 *
		 * @param int $item id.
		 * @return id;
		 */
		public function column_cb( $item ) {
			return sprintf( '<input type="checkbox" name="project_ids[]" value="%d" />', $item->id );
		}

		/**
		 * No projects found.
		 */
		public function no_items() {
			esc_html_e( 'No projects found.', 'mpg' );
		}

		/**
		 * Sortable columans.
		 */
		protected function get_sortable_columns() {
			$sortable_columns = array(
				'name'       => array( 'name', false ),
				'created_at' => array( 'created_at', false ),
			);
			return $sortable_columns;
		}
	}
}
