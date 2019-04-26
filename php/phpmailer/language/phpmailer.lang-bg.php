ame);

    /**
     * Reads a boolean value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final boolean readBool();
    /**
     * Reads a byte value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final byte readInt8();
    /**
     * Reads a short value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final short readInt16();
    /**
     * Reads a int value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final int readInt32();
    /**
     * Reads a long value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final long readInt64();
    /**
     * Reads a float value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final float readFloat();
    /**
     * Reads a double value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final double readDouble();
    /**
     * Reads a String value from the current location in the parcel.
     * @return value parsed from the parcel
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public native final String readString();

    /**
     * Reads an array of boolean values from the parcel.
     * @return array of parsed values
     * @throws IllegalArgumentException if the parcel has no more data
     */
    private native final boolean[] readBoolVectorAsArray();
    /**
 