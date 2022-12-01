<?php
/**
 * Manage project list.
 *
 * @package MPG
 *
 * phpcs:disable WordPress.Security.NonceVerification.Recommended
 */

// If check class exists or not.
if ( ! class_exists( 'ProjectsListManage' ) ) {

	/**
	 * Declare class `ProjectsListManage`
	 */
	class ProjectsListManage {

		/**
		 * Display form Data
		 *
		 * @param string $search Search string.
		 * @param int    $per_page per page.
		 * @return mix.
		 */
		public function projects_list( $search = '', $per_page = 20 ) {
			global $wpdb;
			$where = '';
			if ( ! empty( $search ) ) {
				$where .= " WHERE name LIKE '%$search%'";
			}
			$paged   = isset( $_REQUEST['paged'] ) ? max( 0, intval( $_REQUEST['paged'] - 1 ) * $per_page ) : 0;
			$orderby = 'ORDER BY name DESC';
			if ( ! empty( $_GET['orderby'] ) && ! empty( $_GET['order'] ) ) {
				$orderby = sanitize_text_field( wp_unslash( $_GET['orderby'] ) );
				$order   = strtoupper( sanitize_text_field( wp_unslash( $_GET['order'] ) ) );
				$orderby = "ORDER by $orderby $order";
			}
			$where        .= " $orderby LIMIT $per_page OFFSET $paged";
			$table_name    = $wpdb->prefix . MPG_Constant::MPG_PROJECTS_TABLE;
			$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" . $where ); // phpcs:ignore
			return $retrieve_data;
		}

		/**
		 * Total Projects
		 *
		 * @return object.
		 */
		public function total_projects() {
			global $wpdb;
			$table_name = $wpdb->prefix . MPG_Constant::MPG_PROJECTS_TABLE;
			$search     = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
			$where      = '';
			if ( ! empty( $search ) ) {
				$where .= " WHERE name LIKE '%$search%'";
			}
			$total_projects = $wpdb->get_results( "SELECT COUNT(*) as count FROM $table_name" . $where ); // phpcs:ignore
			$total_projects = reset( $total_projects );
			return (int) $total_projects->count;
		}

		/**
		 * Delete record by id
		 *
		 * @param int $del_id Id.
		 * @return mix.
		 */
		public function delete_project( $del_id ) {
			global $wpdb;
			$table_name = $wpdb->prefix . MPG_Constant::MPG_PROJECTS_TABLE;
			return $wpdb->delete( $table_name, array( 'id' => $del_id ) ); // phpcs:ignore
		}

		/**
		 * Bulk delete
		 *
		 * @param int $ids ids.
		 */
		public function bulk_delete( $ids ) {
			global $wpdb;
			if ( ! empty( $ids ) ) {
				$table_name = $wpdb->prefix . MPG_Constant::MPG_PROJECTS_TABLE;
				$ids        = implode( ',', array_map( 'absint', $ids ) );
				return $wpdb->query( "DELETE FROM $table_name WHERE id IN( $ids )" ); // phpcs:ignore
			}
			return false;
		}
	}
}
