package gr.tourme.model;

import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;

public class Adventure {
	@JsonIgnore
	public Integer adventure_id;
	@JsonIgnore
	public Integer user_id;
	public String title;
	public String description;
	public String loc_name;
	public String loc_address;
	public Double loc_latitude;
	public Double loc_longitude;
	public Double loc_radius_km;
	public String loc_photo_url;
	public String date_start;
	public String date_end;
	public Integer interest_age_min;
	public Integer interest_age_max;
	public Integer interest_gender;
	public String interest_relationship;
	public String op_budget;
	public List<String> op_accomodation;
	public String op_interests;
	public String op_habbits;

	@Override
	public String toString() {
		return "Adventure [title=" + title + ", description=" + description + ", loc_name=" + loc_name
				+ ", loc_address=" + loc_address + ", loc_latitude=" + loc_latitude + ", loc_longitude=" + loc_longitude
				+ ", loc_radius_km=" + loc_radius_km + ", loc_photo_url=" + loc_photo_url + ", date_start=" + date_start
				+ ", date_end=" + date_end + ", interest_age_min=" + interest_age_min + ", interest_age_max="
				+ interest_age_max + ", interest_gender=" + interest_gender + ", interest_relationship="
				+ interest_relationship + ", op_budget=" + op_budget + ", op_accomodation=" + op_accomodation
				+ ", op_interests=" + op_interests + ", op_habbits=" + op_habbits + "]";
	}

}
