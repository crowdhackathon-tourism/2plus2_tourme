package gr.tourme.db;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

import javax.sql.DataSource;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.stereotype.Repository;

import gr.tourme.model.Adventure;

@Repository
public class AdventureDAO {
	private JdbcTemplate jdbcTemplate;
	private static final Logger logger = LoggerFactory
			.getLogger(AdventureDAO.class);

	//Configure multiple datasources based on http://stackoverflow.com/a/14906648/4235623
	@Autowired
	public void setDataSource(@Qualifier("dataSource.tourme") DataSource dataSource) {
		this.jdbcTemplate = new JdbcTemplate(dataSource);
	}
	
	public List<Adventure> getAdventures(int userID) {
		String query = "SELECT id,title,description FROM "
				+ "tm_adventures WHERE user_id=? ";
		// List of question types found in
		// http://manual.limesurvey.org/Expression_Manager#Qcode_Variable_Naming
		// A short description can be found on https://support.ekt.gr/view.php?id=8066#c45545
		List<Adventure> adventures = jdbcTemplate.query(query,
				new Object[] { userID }, ADVENTURE_MAPPER);
		logger.debug(adventures.toString());
		return adventures;
	}

	private static final RowMapper<Adventure> ADVENTURE_MAPPER  = new RowMapper<Adventure>() {
		public Adventure mapRow(ResultSet rs, int rowNum) throws SQLException {
			Adventure adv = new Adventure();
			adv.adventure_id=rs.getInt("id");
			adv.title=rs.getString("title");
			adv.description=rs.getString("description");
			return adv;
		}
	};
}
