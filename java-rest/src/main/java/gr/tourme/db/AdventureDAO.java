package gr.tourme.db;

import java.math.BigDecimal;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;
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
	
	//Item separator for strings
	private static final String TRIPLE_HYPHEN = "|||";
	private static final String TRIPLE_HYPHEN_REGEX = "\\|\\|\\|";
	
	private static final String GET_ALL_SQL = "SELECT adventure_id,user_id,title,description,loc_name,loc_address,loc_latitude,loc_longitude,"
			+ "loc_radius_km,loc_photo_url,date_start,date_end,interest_age_min,interest_age_max,"
			+ "interest_gender, interest_relationship, op_budget, op_accomodation,"
			+ "op_interests, op_habbits, NULL as distance, NULL as user_photo_url FROM tm_adventures";
	private static final String GET_USER_ADVENTURES_SQL = GET_ALL_SQL + " WHERE user_id=? ";
	public List<Adventure> getAdventures(int userID) {
		List<Adventure> adventures;
		if (userID == -1)
			adventures= jdbcTemplate.query(GET_ALL_SQL, ADVENTURE_MAPPER);
		else
			adventures = jdbcTemplate.query(GET_USER_ADVENTURES_SQL,
				new Object[] { userID }, ADVENTURE_MAPPER);
		logger.debug(adventures.toString());
		return adventures;
	}
	
	private static final String INSERT_ADVENTURE_SQL = "insert into tm_adventures (user_id,title,description,loc_name,loc_address,"
			+"loc_latitude,loc_longitude,loc_radius_km,loc_photo_url,date_start,date_end,"
			+"interest_age_min,interest_age_max,interest_gender,interest_relationship,op_budget,"
			+"op_accomodation,op_interests,op_habbits)"
			+"values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	public void insert(Adventure adv) {
		String accommodationStr = String.join(TRIPLE_HYPHEN, adv.op_accomodation);
    	logger.debug(accommodationStr);
		jdbcTemplate.update(INSERT_ADVENTURE_SQL, new Object[] { adv.user_id, adv.title,adv.description,adv.loc_name,adv.loc_address,
				adv.loc_latitude,adv.loc_longitude,adv.loc_radius_km,adv.loc_photo_url,adv.date_start,adv.date_end,
				adv.interest_age_min,adv.interest_age_max,adv.interest_gender,adv.interest_relationship,adv.op_budget,
				accommodationStr,adv.op_interests,adv.op_habbits});
	}
    	
	private static final String UPDATE_ADVENTURE_SQL = "update tm_adventures set title=?,loc_name=?, where id=?"; 
	public void update(Adventure adv) {
		jdbcTemplate.update(UPDATE_ADVENTURE_SQL,new Object[]{adv.title,adv.loc_name,adv.adventure_id});
	}
	
	private static final String GET_CLOSE_POINTS_SQL = "CALL get_close_points(?, ?, ?, NULL, 20, ?)";
	public List<Adventure> getSuggestions(BigDecimal latitude, BigDecimal longitude, BigDecimal radius, int excludeUserID) {
		List<Adventure> adventures;
			adventures = jdbcTemplate.query(GET_CLOSE_POINTS_SQL,
				new Object[] { latitude, longitude, radius, excludeUserID }, ADVENTURE_MAPPER);
		logger.debug(adventures.toString());
		return adventures;
	}

	private static final RowMapper<Adventure> ADVENTURE_MAPPER  = new RowMapper<Adventure>() {
		public Adventure mapRow(ResultSet rs, int rowNum) throws SQLException {
			Adventure adv = new Adventure();
			adv.adventure_id=rs.getInt("adventure_id");
			adv.user_id=rs.getInt("user_id");
			adv.title=rs.getString("title");
			adv.description=rs.getString("description");
			adv.loc_name=rs.getString("loc_name");
			adv.loc_address=rs.getString("loc_address");
			adv.loc_latitude=rs.getBigDecimal("loc_latitude");
			adv.loc_longitude=rs.getBigDecimal("loc_longitude");
			adv.loc_radius_km=rs.getBigDecimal("loc_radius_km");			
			adv.loc_photo_url=rs.getString("loc_photo_url");
			adv.date_start=rs.getString("date_start");
			adv.date_end=rs.getString("date_end");
			adv.interest_age_min=rs.getInt("interest_age_min");
			adv.interest_age_max=rs.getInt("interest_age_max");
			adv.interest_gender=rs.getString("interest_gender");
			adv.interest_relationship=rs.getString("interest_relationship");
			adv.interest_gender=rs.getString("interest_gender");
			adv.op_budget=rs.getString("op_budget");
			String accommodationStr=rs.getString("op_accomodation");
			if (accommodationStr!=null)
			// Accommodation is split by 3 hyphens. i.e. |||
				adv.op_accomodation = Arrays.asList(accommodationStr.split(TRIPLE_HYPHEN_REGEX));
			else
				adv.op_accomodation = new ArrayList<String>();
			adv.op_interests=rs.getString("op_interests");
			adv.op_habbits=rs.getString("op_habbits");
			if (rs.getString("distance")==null)
				adv.distance=null;
			else
				adv.distance=rs.getDouble("distance");
			adv.user_photo_url=rs.getString("user_photo_url");
			return adv;
		}
	};
}
